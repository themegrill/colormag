(function ($, api) {
	api.bind('ready', function () {
		api.panel('colormag_header_panel', (panel) => {
			panel.expanded.bind((isExpanded) => {
				if (isExpanded) {
					$('.wp-full-overlay').attr(`data-colormag-header-panel`, 'active');
				} else {
					$('.wp-full-overlay').attr(`data-colormag-header-panel`, 'inactive');
				}
				const control = api.control('colormag_builder_heading');
				if (
					control &&
					control.deferred &&
					'resolved' === control.deferred.embedded.state()
				)
					return;
				if (control && typeof control.renderContent === 'function') {
					control.renderContent();
				}
				if (control && control.deferred && control.deferred.embedded) {
					control.deferred.embedded.resolve();
				}
				if (control && control.container) {
					control.container.trigger('init');
				}
			});
		});
	});

	// Function to update skin choices when color palette changes
	window.colormag_update_skin_choices = function (colorPaletteValue) {
		const skinControl = api.control('colormag_dark_skin');
		if (!skinControl) return;

		// Get predefined presets
		const predefinedPresets = [
			{ id: 'preset-1', name: 'Preset 1' },
			{ id: 'preset-2', name: 'Preset 2' },
			{ id: 'preset-3', name: 'Preset 3' },
			{ id: 'preset-4', name: 'Preset 4' },
			{ id: 'preset-5', name: 'Preset 5' },
		];

		// Get custom presets from color palette value
		const customPresets =
			colorPaletteValue && colorPaletteValue.custom
				? colorPaletteValue.custom
				: [];

		// Combine all presets
		const allPresets = [...predefinedPresets, ...customPresets];

		// Create choices object
		const choices = {};
		allPresets.forEach((preset) => {
			const name =
				preset.name || (preset.id ? `Custom ${preset.id}` : 'Unknown');
			const id = preset.id || 'unknown';
			choices[id] = name;
		});

		// Update the control choices
		skinControl.params.choices = choices;

		// Re-render the control to show updated choices
		if (typeof skinControl.renderContent === 'function') {
			skinControl.renderContent();
		}
	};

	// Listen for changes to color palette
	api('colormag_color_palette', function (setting) {
		setting.bind(function (value) {
			colormag_update_skin_choices(value);
		});
	});
})(jQuery, wp.customize);
