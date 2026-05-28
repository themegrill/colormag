import { useInstanceId } from '@wordpress/compose';
import React, { useCallback, useEffect, useRef, useState } from 'react';

export function useCallbackRef<T extends (...args: any[]) => any>(
	callback: T | undefined,
	deps: React.DependencyList = [],
) {
	const callbackRef = useRef(callback);

	useEffect(() => {
		callbackRef.current = callback;
	});

	// eslint-disable-next-line react-hooks/exhaustive-deps
	return useCallback(((...args) => callbackRef.current?.(...args)) as T, deps);
}

export type UseDisclosureProps = {
	isOpen?: boolean;
	defaultIsOpen?: boolean;
	onClose?(): void;
	onOpen?(): void;
	id?: string;
};

export type HTMLProps = React.HTMLAttributes<HTMLElement>;

export const useDisclosure = (props: UseDisclosureProps = {}) => {
	const {
		onClose: onCloseProp,
		onOpen: onOpenProp,
		isOpen: isOpenProp,
		id: idProp,
	} = props;

	const handleOpen = useCallbackRef(onOpenProp);
	const handleClose = useCallbackRef(onCloseProp);

	const [isOpenState, setIsOpen] = useState(props.defaultIsOpen || false);

	const isOpen = isOpenProp !== undefined ? isOpenProp : isOpenState;

	const isControlled = isOpenProp !== undefined;

	const uid = useInstanceId(useDisclosure);
	const id = idProp ?? `disclosure-${uid}`;

	const onClose = useCallback(() => {
		if (!isControlled) {
			setIsOpen(false);
		}
		handleClose?.();
	}, [isControlled, handleClose]);

	const onOpen = useCallback(() => {
		if (!isControlled) {
			setIsOpen(true);
		}
		handleOpen?.();
	}, [isControlled, handleOpen]);

	const onToggle = useCallback(() => {
		if (isOpen) {
			onClose();
		} else {
			onOpen();
		}
	}, [isOpen, onOpen, onClose]);

	function getButtonProps(props: HTMLProps = {}): HTMLProps {
		return {
			...props,
			'aria-expanded': isOpen,
			'aria-controls': id,
			onClick(event) {
				props.onClick?.(event);
				onToggle();
			},
		};
	}

	function getDisclosureProps(props: HTMLProps = {}): HTMLProps {
		return {
			...props,
			hidden: !isOpen,
			id,
		};
	}

	return {
		isOpen,
		onOpen,
		onClose,
		onToggle,
		isControlled,
		getButtonProps,
		getDisclosureProps,
	};
};
