import { registerPlugin } from '@wordpress/plugins';
import { Plugin } from './Plugin';
import './meta.scss';

registerPlugin('colormag-meta-setting-sidebar', { render: Plugin });
