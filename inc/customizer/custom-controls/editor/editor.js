/**
 * Editor control JS to handle the editor rendering within customize control.
 *
 * File `editor.js`.
 *
 * @package ColorMag
 */
wp.customize.controlConstructor[ 'colormag-editor' ] = wp.customize.Control.extend(
	{

		ready : function () {

			'use strict';

			var control = this,
				id      = 'editor_' + control.id;

			if ( wp.editor && wp.editor.initialize ) {
				wp.editor.initialize(
					id,
					{
						tinymce: {
							wpautop: true,
							setup: function (editor) {
								editor.on(
									'Paste Change input Undo Redo',
									function() {
										var content = editor.getContent();
										wp.customize.instance( control.id ).set( content );
									}
								)
							}
						},
						quicktags: true,
						mediaButtons: true
						}
				);
			}

		},

	}
);
