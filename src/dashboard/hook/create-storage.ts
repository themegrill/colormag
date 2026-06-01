import { useCallback, useEffect, useState } from 'react';

const useWindowEvent = <T extends string = keyof WindowEventMap>(
	type: T,
	handler: T extends keyof WindowEventMap
		? (this: Window, ev: WindowEventMap[T]) => void
		: (this: Window, ev: CustomEvent) => void,
	options?: boolean | AddEventListenerOptions,
) => {
	useEffect(() => {
		// @ts-ignore
		window.addEventListener(type, handler, options);
		// @ts-ignore
		return () => window.removeEventListener(type, handler, options);
	}, [type, handler, options]);
};

export type StorageType = 'localStorage' | 'sessionStorage';

export interface UseStorageOptions<T> {
	key: string;
	defaultValue?: T;
	getInitialValueInEffect?: boolean;
	serialize?: (value: T) => string;
	deserialize?: (value: string) => T;
}

const serializeJSON = <T>(value: T, hookName: string) => {
	try {
		return JSON.stringify(value);
	} catch (error) {
		throw new Error(`Filed to serialize ${hookName} value`);
	}
};

const deserializeJSON = (value: string) => {
	try {
		return JSON.parse(value);
	} catch (error) {
		throw new Error(`Filed to deserialize value`);
	}
};

export const createStorage = <T>(type: StorageType, hookName: string) => {
	const eventName =
		'localStorage' === type
			? 'blockart-local-storage'
			: 'blockart-session-storage';

	const useStorage = ({
		key,
		defaultValue = undefined,
		getInitialValueInEffect = false,
		serialize = (value: T) => serializeJSON(value, hookName),
		deserialize = deserializeJSON,
	}: UseStorageOptions<T>) => {
		const read = useCallback(
			(skip?: boolean): T => {
				if (
					'undefined' === typeof window ||
					!(type in window) ||
					window[type] === null ||
					skip
				) {
					return defaultValue as T;
				}
				const value = window[type].getItem(key);
				return null !== value ? deserialize(value) : (defaultValue as T);
			},
			[key, defaultValue, deserialize],
		);

		const [value, setValue] = useState<T>(read(getInitialValueInEffect));

		const setStorageValue = useCallback(
			(val: T | ((prev: T) => T)) => {
				if (val instanceof Function) {
					setValue((current) => {
						const result = val(current);
						window[type].setItem(key, serialize(result));
						window.dispatchEvent(
							new CustomEvent(eventName, {
								detail: {
									key,
									value: val(current),
								},
							}),
						);
						return result;
					});
				}
			},
			[key, serialize],
		);

		const removeStorageValue = useCallback(() => {
			window[type].removeItem(key);
			window.dispatchEvent(
				new CustomEvent(eventName, {
					detail: { key, value: defaultValue },
				}),
			);
		}, [defaultValue, key]);

		useWindowEvent('storage', (event) => {
			if (event.storageArea === window[type] && event.key === key) {
				setValue(deserialize(event.newValue as string));
			}
		});

		useWindowEvent(eventName, (event) => {
			if (event.detail.key === key) {
				setValue(event.detail.value);
			}
		});

		useEffect(() => {
			if (defaultValue !== undefined && value === undefined) {
				setStorageValue(defaultValue);
			}
		}, [defaultValue, value, setStorageValue]);

		useEffect(() => {
			if (getInitialValueInEffect) {
				setValue(read());
			}
		}, [getInitialValueInEffect, read]);

		return [
			value === undefined ? defaultValue : value,
			setStorageValue,
			removeStorageValue,
		] as const;
	};

	return useStorage;
};
