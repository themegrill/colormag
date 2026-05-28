import React from 'react';
import './dashboard.scss';

import domReady from '@wordpress/dom-ready';
import { createRoot, render } from '@wordpress/element';
import App from './App';

domReady(() => {
	const root = document.getElementById('render_dashboard_page');
	if (!root) return;
	if (createRoot) {
		createRoot(root).render(<App />);
	} else {
		render(<App />, root);
	}
});
