(function() {
	tinymce.PluginManager.add( 'symple_shortcodes_mce_button', function( editor, url ) {
		editor.addButton( 'symple_shortcodes_mce_button', {
			title: 'Shortcodes',
			type: 'menubutton',
			icon: 'icon symple-shortcodes-icon',
			menu: [


				/** Layout **/
				{
					text: 'Layout',
					menu: [

						/* Columns */
						{
							text: 'Columns',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Symple Shortcodes - Insert Column',
									body: [

									// Column FadeIn
									{
										type: 'listbox',
										name: 'columnFadeIn',
										label: 'FadeIn',
										'values': [
											{text: 'False', value: 'false'},
											{text: 'True', value: 'true'}
										]
									},

									// Column Size
									{
										type: 'listbox',
										name: 'columnSize',
										label: 'Size',
										'values': [
											{text: '1/2', value: 'one-half'},
											{text: '1/3', value: 'one-third'},
											{text: '2/3', value: 'two-third'},
											{text: '1/4', value: 'one-fourth'},
											{text: '3/4', value: 'three-fourth'},
											{text: '1/5', value: 'one-fifth'},
											{text: '2/5', value: 'two-fifth'},
											{text: '3/5', value: 'three-fifth'},
											{text: '4/5', value: 'four-fifth'},
											{text: '1/6', value: 'one-sixth'},
											{text: '5/6', value: 'five-sixth'}
										]
									},

									// Column Position
									{
										type: 'listbox',
										name: 'columnPosition',
										label: 'Position',
										'values': [
											{text: 'First', value: 'first'},
											{text: 'Middle', value: 'middle'},
											{text: 'Last', value: 'last'}
										]
									},

									// Column Content
									{
										type: 'textbox',
										name: 'columnContent',
										label: 'Starting Content',
										value: 'Symple Shortcodes is the best Free shortcodes plugin out there.',
										multiline: true,
										minWidth: 300,
										minHeight: 100
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[symple_column size="' + e.data.columnSize + '" position="' + e.data.columnPosition + '" fade_in="' + e.data.columnFadeIn + '"]<br />' + e.data.columnContent + '<br />[/symple_column]');
									}
								});
							}
						}, // End columns

						/* Spacing */
						{
							text: 'Spacing',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Symple Shortcodes - Insert Spacing',
									body: [ {
										type: 'textbox', 
										name: 'spacingSize', 
										label: 'Height In Pixels',
										value: '30'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[symple_spacing size="' + e.data.spacingSize + '"]');
									}
								});
							}
						}, // End spacing

						/* Dividers */
						{
							text: 'Dividers',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Symple Shortcodes - Insert Divider',
									body: [

									// Divider Style
									{
										type: 'listbox',
										name: 'dividerStyle',
										label: 'Size',
										'values': [
											{text: 'Solid', value: 'solid'},
											{text: 'Dashed', value: 'dashed'},
											{text: 'Double', value: 'double'}
										]
									},

									// Divider Top Margin
									{
										type: 'textbox', 
										name: 'dividerTopMargin', 
										label: 'Top Margin In Pixels',
										value: '20'
									},

									// Divider Bottom Margin
									{
										type: 'textbox', 
										name: 'dividerBottomMargin', 
										label: 'Bottom Margin In Pixels',
										value: '20'
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[symple_divider style="' + e.data.dividerStyle + '" margin_top="' + e.data.dividerTopMargin + '" margin_bottom="' + e.data.dividerBottomMargin + '"]');
									}
								});
							}
						} // End divider

					]
				}, // End Layout Section


				/** Elements **/
				{
					text: 'Elements',
					menu: [

						/* Buttons */
						{
							text: 'Button',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Symple Shortcodes - Insert Button',
									body: [

									// Button Text
									{
										type: 'textbox',
										name: 'buttonText',
										label: 'Button: Text',
										value: 'Download'
									},

									// Button URL
									{
										type: 'textbox',
										name: 'buttonUrl',
										label: 'Button: URL',
										value: 'http://dankov-theme.com'
									},

									// Button Border Radius
									{
										type: 'textbox',
										name: 'buttonBorderRadius',
										label: 'Button: Border Radius',
										value: '3px'
									},

									// Button Color
									{
										type: 'listbox',
										name: 'buttonColor',
										label: 'Button: Color',
										'values': [
											{text: 'Black', value: 'black'},
											{text: 'Blue', value: 'blue'},
											{text: 'Brown', value: 'brown'},
											{text: 'Grey', value: 'grey'},
											{text: 'Green', value: 'green'},
											{text: 'Gold', value: 'gold'},
											{text: 'Orange', value: 'orange'},
											{text: 'Pink', value: 'pink'},
											{text: 'Red', value: 'red'},
											{text: 'Rosy', value: 'rosy'},
											{text: 'Teal', value: 'teal'}
										]
									},

									// Button Size
									{
										type: 'listbox',
										name: 'buttonSize',
										label: 'Button: Size',
										'values': [
											{text: 'Default', value: 'default'},
											{text: 'Small', value: 'small'},
											{text: 'Medium', value: 'medium'},
											{text: 'Large', value: 'large'}
										]
									},

									// Button Link Target
									{
										type: 'listbox',
										name: 'buttonLinkTarget',
										label: 'Button: Link Target',
										'values': [
											{text: 'Self', value: 'self'},
											{text: 'Blank', value: 'blank'}
										]
									},

									// Button Rel
									{
										type: 'listbox',
										name: 'buttonRel',
										label: 'Button: Rel',
										'values': [
											{text: 'None', value: ''},
											{text: 'Nofollow', value: 'nofollow'}
										]
									},

									// Button Left Icon
									{
										type: 'textbox',
										name: 'buttonLeftIcon',
										label: 'Button: Left Icon (FontAwesome Class Name)',
										value: ''
									},

									// Button Right Icon
									{
										type: 'textbox',
										name: 'buttonRightIcon',
										label: 'Button: Right Icon (FontAwesome Class Name)',
										value: ''
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[symple_button url="' + e.data.buttonUrl + '" color="' + e.data.buttonColor + '" size="' + e.data.buttonSize + '" border_radius="' + e.data.buttonBorderRadius + '" target="' + e.data.buttonLinkTarget + '" rel="' + e.data.buttonRel + '" icon_left="' + e.data.buttonLeftIcon + '" icon_right="' + e.data.buttonRightIcon + '"]' + e.data.buttonText + '[/symple_button]');
									}
								});
							}
						}, // End button

						
						/* Heading */
						{
							text: 'Heading',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Symple Shortcodes - Insert Heading',
									body: [

									// Heading Title
									{
										type: 'textbox',
										name: 'headingTitle',
										label: 'Title',
										value: 'This is a heading'
									},

									// Heading Font Size
									{
										type: 'textbox',
										name: 'headingFontSize',
										label: 'Font Size',
										value: ''
									},

									// Heading Color
									{
										type: 'textbox',
										name: 'headingColor',
										label: 'Heading Hex Color',
										value: ''
									},

									// Heading Top Margin
									{
										type: 'textbox',
										name: 'headingMarginTop',
										label: 'Top Margin',
										value: '30'
									},

									// Heading Bottom Margin
									{
										type: 'textbox',
										name: 'headingMarginBottom',
										label: 'Bottom Margin',
										value: '30'
									},

									// Heading Type
									{
										type: 'listbox',
										name: 'headingType',
										label: 'Type',
										'values': [
											{text: 'h1', value: 'h1'},
											{text: 'h2', value: 'h2'},
											{text: 'h3', value: 'h3'},
											{text: 'h4', value: 'h4'},
											{text: 'h5', value: 'h5'},
											{text: 'span', value: 'span'},
											{text: 'div', value: 'div'}
										]
									},

									// Heading Style
									{
										type: 'listbox',
										name: 'headingStyle',
										label: 'Style',
										'values': [
											{text: 'Solid Bottom Border', value: ''},
											{text: 'Double Line', value: 'double-line'},
											{text: 'Dashed Line', value: 'dashed-line'},
											{text: 'Dotted Line', value: 'dotted-line'}
										]
									},

									// Heading Text Align
									{
										type: 'listbox',
										name: 'headingTextAlign',
										label: 'Text Align',
										'values': [
											{text: 'Left', value: 'left'},
											{text: 'Center', value: 'center'},
											{text: 'Right', value: 'right'}
										]
									},

									// Heading Left Icon
									{
										type: 'textbox',
										name: 'headingLeftIcon',
										label: 'Left Icon (FontAwesome Class Name)',
										value: ''
									},

									// Heading Right Icon
									{
										type: 'textbox',
										name: 'headingRightIcon',
										label: 'Right Icon (FontAwesome Class Name)',
										value: ''
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[symple_heading style="' + e.data.headingStyle + '" title="' + e.data.headingTitle + '" type="' + e.data.headingType + '" font_size="' + e.data.headingFontSize + '" text_align="' + e.data.headingTextAlign + '" margin_top="' + e.data.headingMarginTop + '" margin_bottom="' + e.data.headingMarginBottom + '" color="' + e.data.buttonText + '" icon_left="' + e.data.headingLeftIcon + '" icon_right="' + e.data.headingRightIcon + '"]' );
									}
								});
							}
						}, // End heading


						/* Boxes */
						{
							text: 'Boxes',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Symple Shortcodes - Insert Box',
									body: [

									// Box Color
									{
										type: 'listbox',
										name: 'boxColor',
										label: 'Size',
										'values': [
											{text: 'Black', value: 'black'},
											{text: 'Blue', value: 'blue'},
											{text: 'Green', value: 'green'},
											{text: 'Gray', value: 'gray'},
											{text: 'Red', value: 'red'},
											{text: 'Yellow', value: 'yellow'},
											{text: 'White', value: 'white'}
										]
									},

									// Box FadeIn
									{
										type: 'listbox',
										name: 'boxFadeIn',
										label: 'FadeIn',
										'values': [
											{text: 'False', value: 'false'},
											{text: 'True', value: 'true'}
										]
									},

									// Box Float
									{
										type: 'listbox',
										name: 'boxFloat',
										label: 'Float',
										'values': [
											{text: 'Center', value: 'center'},
											{text: 'Left', value: 'left'},
											{text: 'Right', value: 'right'}
										]
									},

									// Box Textalign
									{
										type: 'listbox',
										name: 'boxTextAlign',
										label: 'Text Align',
										'values': [
											{text: 'Left', value: 'left'},
											{text: 'Right', value: 'right'},
											{text: 'Center', value: 'center'}
										]
									},

									// Box Width
									{
										type: 'textbox',
										name: 'boxWidth',
										label: 'Width (px or %)',
										text: '100%'
									},

									// Box Content
									{
										type: 'textbox',
										name: 'boxContent',
										label: 'Starting Content',
										value: 'Lorem ipsum dolor sit amet.',
										multiline: true,
										minWidth: 300,
										minHeight: 100
									}],
									onsubmit: function( e ) {
										editor.insertContent( '[symple_box color="' + e.data.boxColor + '" fade_in="' + e.data.boxFadeIn + '" float="' + e.data.boxFloat + '" text_align="' + e.data.boxTextAlign + '" width="' + e.data.boxWidth + '"]<br />' + e.data.boxContent + '<br />[/symple_box]' );
									}
								});
							}
						}, // End boxes


						/* Highlights */
						{
							text: 'Highlights',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Symple Shortcodes - Insert Highlight',
									body: [

									// Highlight Color
									{
										type: 'listbox',
										name: 'highlightColor',
										label: 'Size',
										'values': [
											{text: 'Blue', value: 'blue'},
											{text: 'Green', value: 'green'},
											{text: 'Yellow', value: 'yellow'},
											{text: 'Red', value: 'red'},
											{text: 'Gray', value: 'gray'}
										]
									},

									// Highlight Content
									{
										type: 'textbox', 
										name: 'highlightContent', 
										label: 'Highlighted Text',
										value: 'hey check me out'
									}],
									onsubmit: function( e ) {
										editor.insertContent( '[symple_highlight color="' + e.data.highlightColor + '"]' + e.data.highlightContent + '[/symple_highlight]');
									}
								});
							}
						}, // End highlights


						/* Google Map */
						{
							text: 'Google Map',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Symple Shortcodes - Insert Google Map',
									body: [

									// Google Map Title
									{
										type: 'textbox',
										name: 'gmapTitle',
										label: 'Title',
										value: 'Welcome To Las Vegas'
									},

									// Google Map Location
									{
										type: 'textbox',
										name: 'gmapLocation',
										label: 'Location',
										value: 'Las Vegas, Nevada'
									},

									// Google Map Height
									{
										type: 'textbox',
										name: 'gmapHeight',
										label: 'Height',
										value: '300'
									},

									// Google Map Zoom
									{
										type: 'textbox',
										name: 'gmapZoom',
										label: 'Zoom',
										value: '15'
									}

									],
									onsubmit: function( e ) {
										editor.insertContent( '[symple_googlemap title="' + e.data.gmapTitle + '" location="' + e.data.gmapLocation + '" height="' + e.data.gmapHeight + '" zoom="' + e.data.gmapZoom + '"]');
									}
								});
							}
						}, // End GoogleMaps


						/* Testimonial */
						{
							text: 'Testimonial',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Symple Shortcodes - Insert Testimonial',
									body: [

									// Testimonial FadeIn
									{
										type: 'listbox',
										name: 'testimonialFadeIn',
										label: 'FadeIn',
										'values': [
											{text: 'False', value: 'false'},
											{text: 'True', value: 'true'}
										]
									},

									// Testimonial Author
									{
										type: 'textbox',
										name: 'testimonialAuthor',
										label: 'Author',
										value: 'Dohn Doe'
									},

									// Testimonial Content
									{
										type: 'textbox',
										name: 'testimonialContent',
										label: 'Content',
										value: 'Total is the best WordPress theme I have ever used!',
										multiline: true,
										minWidth: 300,
										minHeight: 100
									}

									],
									onsubmit: function( e ) {
										editor.insertContent( '[symple_testimonial by="' + e.data.testimonialAuthor + '" fade_in="' + e.data.testimonialFadeIn + '"]' + e.data.testimonialContent + '[/symple_testimonial]');
									}
								});
							}
						}, // End Testimonial


						/* Skillbars */
						{
							text: 'Skillbars',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Symple Shortcodes - Insert Skillbar',
									body: [

									// Skillbar Title
									{
										type: 'textbox',
										name: 'skillbarTitle',
										label: 'Skill',
										value: 'Web Design'
									},

									// Skillbar Percentage
									{
										type: 'textbox',
										name: 'skillbarPercentage',
										label: 'Percentage',
										value: '85'
									},

									// Skillbar Color
									{
										type: 'textbox',
										name: 'skillbarColor',
										label: 'Color Hex',
										value: '#65C25C'
									},

									// Skillbar Show Percent
									{
										type: 'listbox',
										name: 'skillbarShowPercent',
										label: 'Show Percent',
										'values': [
											{text: 'True', value: 'true'},
											{text: 'False', value: 'false'}
										]
									}

									],
									onsubmit: function( e ) {
										editor.insertContent( '[symple_skillbar title="' + e.data.skillbarTitle + '" percentage="' + e.data.skillbarPercentage + '" color="' + e.data.skillbarColor + '" show_percent="' + e.data.skillbarShowPercent + '"]');
									}
								});
							}
						}, // End Skillbar


						/* Callout */
						{
							text: 'Callout',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Symple Shortcodes - Insert Callout',
									body: [

									// Callout FadeIn
									{
										type: 'listbox',
										name: 'calloutFadeIn',
										label: 'FadeIn',
										'values': [
											{text: 'False', value: 'false'},
											{text: 'True', value: 'true'}
										]
									},

									// Callout Button Text
									{
										type: 'textbox',
										name: 'calloutButtonText',
										label: 'Button: Text',
										value: 'Download'
									},

									// Callout Button URL
									{
										type: 'textbox',
										name: 'calloutButtonUrl',
										label: 'Button: URL',
										value: 'http://dankov-theme.com'
									},

									// Callout Button Border Radius
									{
										type: 'textbox',
										name: 'calloutButtonBorderRadius',
										label: 'Button: Border Radius',
										value: '3px'
									},

									// Callout Button Color
									{
										type: 'listbox',
										name: 'calloutButtonColor',
										label: 'Button: Color',
										'values': [
											{text: 'Black', value: 'black'},
											{text: 'Blue', value: 'blue'},
											{text: 'Brown', value: 'brown'},
											{text: 'Grey', value: 'grey'},
											{text: 'Green', value: 'green'},
											{text: 'Gold', value: 'gold'},
											{text: 'Orange', value: 'orange'},
											{text: 'Pink', value: 'pink'},
											{text: 'Red', value: 'red'},
											{text: 'Rosy', value: 'rosy'},
											{text: 'Teal', value: 'teal'}
										]
									},

									// Callout Button Size
									{
										type: 'listbox',
										name: 'calloutButtonSize',
										label: 'Button: Size',
										'values': [
											{text: 'Default', value: 'default'},
											{text: 'Small', value: 'small'},
											{text: 'Medium', value: 'medium'},
											{text: 'Large', value: 'large'}
										]
									},

									// Callout Button Link Target
									{
										type: 'listbox',
										name: 'calloutButtonLinkTarget',
										label: 'Button: Link Target',
										'values': [
											{text: 'Self', value: 'self'},
											{text: 'Blank', value: 'blank'}
										]
									},

									// Callout Button Rel
									{
										type: 'listbox',
										name: 'calloutButtonRel',
										label: 'Button: Rel',
										'values': [
											{text: 'None', value: ''},
											{text: 'Nofollow', value: 'nofollow'}
										]
									},

									// Callout Button Left Icon
									{
										type: 'textbox',
										name: 'calloutButtonLeftIcon',
										label: 'Button: Left Icon (FontAwesome Class Name)',
										value: ''
									},

									// Callout Button Right Icon
									{
										type: 'textbox',
										name: 'calloutButtonRightIcon',
										label: 'Button: Right Icon (FontAwesome Class Name)',
										value: ''
									},

									// Callout Content
									{
										type: 'textbox',
										name: 'calloutContent',
										label: 'Content',
										value: 'Lorem ipsum dolor sit amet.',
										multiline: true,
										minWidth: 300,
										minHeight: 100
									}

									],
									onsubmit: function( e ) {
										editor.insertContent( '[symple_callout fade_in="' + e.data.calloutFadeIn + '" button_text="' + e.data.calloutButtonText + '" button_url="' + e.data.calloutButtonUrl + '" button_color="' + e.data.calloutButtonColor + '" button_size="' + e.data.calloutButtonSize + '" button_border_radius="' + e.data.calloutButtonBorderRadius + '" button_target="' + e.data.calloutButtonLinkTarget + '" button_rel="' + e.data.calloutButtonRel + '" button_icon_left="' + e.data.calloutButtonLeftIcon + '" button_icon_right="' + e.data.calloutButtonRightIcon + '"]<br />' + e.data.calloutContent + '<br />[/symple_callout]');
									}
								});
							}
						}, // End callout

						/* Pricing */
						{
							text: 'Pricing',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Symple Shortcodes - Insert Pricing',
									body: [

									// New Table?
									{
										type: 'listbox',
										name: 'newPricingTable',
										label: 'New Table?',
										'values': [
											{text: 'Yes', value: 'yes'},
											{text: 'No', value: 'no'}
										]
									},

									// Pricing Size
									{
										type: 'listbox',
										name: 'pricingSize',
										label: 'Size',
										'values': [
											{text: '1/2', value: 'one-half'},
											{text: '1/3', value: 'one-third'},
											{text: '2/3', value: 'two-third'},
											{text: '1/4', value: 'one-fourth'},
											{text: '3/4', value: 'three-fourth'},
											{text: '1/5', value: 'one-fifth'},
											{text: '2/5', value: 'two-fifth'},
											{text: '3/5', value: 'three-fifth'},
											{text: '4/5', value: 'four-fifth'},
											{text: '1/6', value: 'one-sixth'},
											{text: '5/6', value: 'five-sixth'}
										]
									},

									// Pricing Position
									{
										type: 'listbox',
										name: 'pricingPosition',
										label: 'Position',
										'values': [
											{text: 'First', value: 'first'},
											{text: 'Middle', value: 'middle'},
											{text: 'Last', value: 'last'}
										]
									},

									// Pricing Featured
									{
										type: 'listbox',
										name: 'pricingFeatured',
										label: 'Featured?',
										'values': [
											{text: 'No', value: 'no'},
											{text: 'Yes', value: 'yes'}
										]
									},

									// Pricing Plan
									{
										type: 'textbox',
										name: 'pricingPlan',
										label: 'Plan',
										value: 'Basic'
									},

									// Pricing Cost
									{
										type: 'textbox',
										name: 'pricingCost',
										label: 'Cost',
										value: '$20'
									},

									// Pricing Per
									{
										type: 'textbox',
										name: 'pricingPer',
										label: 'Per (optional)',
										value: 'per month'
									},

									// Pricing Button Text
									{
										type: 'textbox',
										name: 'pricingButtonText',
										label: 'Button: Text',
										value: 'Purchase'
									},

									// Pricing Button URL
									{
										type: 'textbox',
										name: 'pricingButtonUrl',
										label: 'Button: URL',
										value: 'http://dankov-theme.com'
									},

									// Pricing Button Border Radius
									{
										type: 'textbox',
										name: 'pricingButtonBorderRadius',
										label: 'Button: Border Radius',
										value: '3px'
									},

									// Pricing Button Color
									{
										type: 'listbox',
										name: 'pricingButtonColor',
										label: 'Button: Color',
										'values': [
											{text: 'Black', value: 'black'},
											{text: 'Blue', value: 'blue'},
											{text: 'Brown', value: 'brown'},
											{text: 'Grey', value: 'grey'},
											{text: 'Green', value: 'green'},
											{text: 'Gold', value: 'gold'},
											{text: 'Orange', value: 'orange'},
											{text: 'Pink', value: 'pink'},
											{text: 'Red', value: 'red'},
											{text: 'Rosy', value: 'rosy'},
											{text: 'Teal', value: 'teal'}
										]
									},

									// Pricing Button Size
									{
										type: 'listbox',
										name: 'pricingButtonSize',
										label: 'Button: Size',
										'values': [
											{text: 'Default', value: 'default'},
											{text: 'Small', value: 'small'},
											{text: 'Medium', value: 'medium'},
											{text: 'Large', value: 'large'}
										]
									},

									// Pricing Button Link Target
									{
										type: 'listbox',
										name: 'pricingButtonLinkTarget',
										label: 'Button: Link Target',
										'values': [
											{text: 'Self', value: 'self'},
											{text: 'Blank', value: 'blank'}
										]
									},

									// Pricing Button Rel
									{
										type: 'listbox',
										name: 'pricingButtonRel',
										label: 'Button: Rel',
										'values': [
											{text: 'None', value: ''},
											{text: 'Nofollow', value: 'nofollow'}
										]
									},

									// Pricing Button Left Icon
									{
										type: 'textbox',
										name: 'pricingButtonLeftIcon',
										label: 'Button: Left Icon (FontAwesome Class Name)',
										value: ''
									},

									// Pricing Button Right Icon
									{
										type: 'textbox',
										name: 'pricingButtonRightIcon',
										label: 'Button: Right Icon (FontAwesome Class Name)',
										value: ''
									},

									// Pricing Features
									{
										type: 'textbox',
										name: 'pricingFeatures',
										label: 'Features (ul list is best)',
										value: '<ul><li>30GB Storage</li><li>512MB Ram</li><li>10 databases</li><li>1,000 Emails</li><li>25GB Bandwidth</li></ul>',
										multiline: true,
										minWidth: 400,
										minHeight: 200
									}

									],
									onsubmit: function( e ) {
										if ( e.data.newPricingTable == 'yes' ){
											var $openPricingTable = '[symple_pricing_table]<br />';
											var $closePricingTable = '<br />[/symple_pricing_table]';
										} else {
											var $openPricingTable = '';
											var $closePricingTable = '';
										}
										editor.insertContent( '' + $openPricingTable + '[symple_pricing size="' + e.data.pricingSize + '" position="' + e.data.pricingPosition + '" featured="' + e.data.pricingFeatured + '" plan="' + e.data.pricingPlan + '" cost="' + e.data.pricingCost + '" per="' + e.data.pricingPer + '" button_text="' + e.data.pricingButtonText + '" button_url="' + e.data.pricingButtonUrl + '" button_color="' + e.data.pricingButtonColor + '" button_size="' + e.data.pricingButtonSize + '" button_border_radius="' + e.data.pricingButtonBorderRadius + '" button_target="' + e.data.pricingButtonLinkTarget + '" button_rel="' + e.data.pricingButtonRel + '" button_icon_left="' + e.data.pricingButtonLeftIcon + '" button_icon_right="' + e.data.pricingButtonRightIcon + '"]' + e.data.pricingFeatures + '[/symple_pricing]' + $closePricingTable + '');
									}
								});
							}
						}, // End pricing


						/* Social Icon */
						{
							text: 'Social Icon',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Symple Shortcodes - Insert Social Icon',
									body: [

									// Social Icon
									{
										type: 'listbox',
										name: 'socialIcon',
										label: 'Service',
										'values': [
											{text: 'Twitter', value: 'twitter'},
											{text: 'Facebook', value: 'facebook'},
											{text: 'Flickr', value: 'flickr'},
											{text: 'Forrst', value: 'forrst'},
											{text: 'Github', value: 'github'},
											{text: 'Google Plus', value: 'googleplus'},
											{text: 'Instagram', value: 'instagram'},
											{text: 'LinkedIn', value: 'linkedin'},
											{text: 'Pinterest', value: 'pinterest'},
											{text: 'Tumblr', value: 'tumblr'},
											{text: 'Twitter', value: 'twitter'},
											{text: 'Vimeo', value: 'vimeo'},
											{text: 'Youtube', value: 'youtube'},
											{text: 'RSS', value: 'rss'}
										]
									},

									// Social Icon URL
									{
										type: 'textbox',
										name: 'socialIconUrl',
										label: 'Link URL',
										value: 'http://dankov-theme.com'
									},

									// Social Icon URL Title
									{
										type: 'textbox',
										name: 'socialIconUrlTitle',
										label: 'Title Tag',
										value: 'Follow Me'
									},

									// Social Icon Link Target
									{
										type: 'listbox',
										name: 'socialIconUrlTarget',
										label: 'Link Target',
										'values': [
											{text: 'Self', value: 'self'},
											{text: 'Blank', value: 'blank'}
										]
									},

									// Social Icon Link Rel
									{
										type: 'listbox',
										name: 'socialIconUrlRel',
										label: 'Link Rel',
										'values': [
											{text: 'None', value: ''},
											{text: 'NoFollow', value: 'nofollow'}
										]
									}

									],
									onsubmit: function( e ) {
										editor.insertContent( '[symple_social icon="' + e.data.socialIcon + '" url="' + e.data.socialIconUrl + '" title="' + e.data.socialIconUrlTitle + '" target="' + e.data.socialIconUrlTarget + '" rel="' + e.data.socialIconUrlRel + '"]');
									}
								});
							}
						} // End Social icon


					]
				}, // End Elements Section


				/** jQuery Start **/
				{
				text: 'jQuery',
				menu: [

						/* Accordion */
						{
							text: 'Accordion',
							onclick: function() {
								editor.insertContent( '[symple_accordion]<br />[symple_accordion_section title="Accordion 1"] Your Content [/symple_accordion_section]<br />[symple_accordion_section title="Accordion 2"] Your Content [/symple_accordion_section]<br />[/symple_accordion]');
							}
						}, // End accordion

						/* Toggle */
						{
							text: 'Toggle',
							onclick: function() {
								editor.insertContent( '[symple_toggle title="Your Toggle Title" state="closed"] Your Content [/symple_toggle]');
							}
						}, // End toggle

						/* Tabs */
						{
							text: 'Tabs',
							onclick: function() {
								editor.insertContent( '[symple_tabgroup]<br />[symple_tab title="Tab 1"] Your Content [/symple_tab]<br />[symple_tab title="Tab 2"] Your Content [/symple_tab]<br />[symple_tab title="Tab 3"] Your Content [/symple_tab]<br />[/symple_tabgroup]');
							}
						}, // End tabs

					]
				} // End jQuery section

			]
		});
	});
})();