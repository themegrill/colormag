import { Prettify } from '../types';
import { createStorage, UseStorageOptions } from './create-storage';

const useLocalStorage = <T = string>(props: Prettify<UseStorageOptions<T>>) =>
	createStorage<T>('localStorage', 'use-local-storage')(props);

export default useLocalStorage;
