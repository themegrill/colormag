import { createReduxStore, register } from '@wordpress/data';
import { localized } from '../utils/global';

export const COLORMAG_DASHBOARD_STORE = 'colormag/dashboard';

type RootState = {
	plugins: typeof localized.plugins;
	themes: typeof localized.themes;
};

const INITIAL_STATE: RootState = {
	plugins: localized.plugins,
	themes: localized.themes,
};

export const dashboardStore = createReduxStore(COLORMAG_DASHBOARD_STORE, {
	reducer(
		state = INITIAL_STATE,
		action: {
			type: string;
			payload: {
				[key in keyof typeof localized.plugins]:
					| 'active'
					| 'inactive'
					| 'not-installed';
			};
		},
	) {
		switch (action.type) {
			case 'UPDATE_PLUGINS_STATUS':
				return {
					...state,
					plugins: {
						...state.plugins,
						...action.payload,
					},
				};
			case 'UPDATE_THEMES_STATUS':
				return {
					...state,
					themes: {
						...state.themes,
						...action.payload,
					},
				};
		}
		return state;
	},
	actions: {
		setPluginsStatus(plugins: {
			[key in keyof typeof localized.plugins]:
				| 'active'
				| 'inactive'
				| 'not-installed';
		}) {
			return {
				type: 'UPDATE_PLUGINS_STATUS',
				payload: plugins,
			};
		},
		setThemesStatus(themes: {
			[key in keyof typeof localized.themes]:
				| 'active'
				| 'inactive'
				| 'not-installed';
		}) {
			return {
				type: 'UPDATE_THEMES_STATUS',
				payload: themes,
			};
		},
	},
	selectors: {
		getPluginsStatus(state: RootState) {
			return state.plugins;
		},
		getPluginStatus(state: RootState, plugin: keyof typeof localized.plugins) {
			return state.plugins[plugin];
		},
		getThemesStatus(state: RootState) {
			return state.themes;
		},
		getThemeStatus(state: RootState, theme: keyof typeof localized.themes) {
			return state.themes[theme];
		},
	},
});

register(dashboardStore);
