(function (wp) {
	const { registerBlockType } = wp.blocks;
	const { __ } = wp.i18n;
	const { InspectorControls, MediaUpload, MediaUploadCheck, useBlockProps } =
		wp.blockEditor || wp.editor;
	const {
		PanelBody,
		ToggleControl,
		TextControl,
		RangeControl,
		SelectControl,
		Button,
	} = wp.components;
	const ServerSideRender = wp.serverSideRender;
	const el = wp.element.createElement;

	registerBlockType("edw/nav-pages", {
		title: __("Pages Nav", "edwbasic-theme"),
		icon: "menu",
		category: "theme",
		// attributes: {
		// 	depth: { type: "number", default: 1 },
		// 	exclude: { type: "string", default: "" }, // comma-separated page IDs
		// 	includeHome: { type: "boolean", default: true },
		// 	homeLabel: { type: "string", default: "Home" },
		// 	orderBy: { type: "string", default: "menu_order" }, // 'menu_order' or 'title'z
		// 	showLogo: { type: "boolean", default: true },
		// 	logoId: { type: "number", default: 0 },
		// 	logoUrl: { type: "string", default: "" },
		// 	logoAlt: { type: "string", default: "" },
		// 	logoWidth: { type: "number", default: 120 },
		// 	logoLinkHome: { type: "boolean", default: true },
		// 	brandPosition: { type: "string", default: "left" },
		// },
		edit: ({ attributes, setAttributes }) => {
			const {
				depth,
				exclude,
				includeHome,
				homeLabel,
				orderBy,
				showLogo,
				logoId,
				logoUrl,
				logoAlt,
				logoWidth,
				logoLinkHome,
				brandPosition,
			} = attributes;
			const blockProps = useBlockProps({
				className: "edw-pages-nav__preview",
			});

			return el(
				wp.element.Fragment,
				null,
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: __("Items", "edwbasic-theme") },
						el(RangeControl, {
							label: __("Depth", "edwbasic-theme"),
							help: __(
								"1 = top-level only; 2 = include one level of children; 0 = unlimited",
								"edwbasic-theme"
							),
							min: 0,
							max: 5,
							value: depth,
							onChange: (v) => setAttributes({ depth: v }),
						}),
						el(SelectControl, {
							label: __("Order by", "edwbasic-theme"),
							value: orderBy,
							options: [
								{
									label: __(
										"Menu order, then title",
										"edwbasic-theme"
									),
									value: "menu_order",
								},
								{
									label: __("Title (A→Z)", "edwbasic-theme"),
									value: "title",
								},
							],
							onChange: (v) => setAttributes({ orderBy: v }),
						}),
						el(TextControl, {
							label: __(
								"Exclude IDs (comma-separated)",
								"edwbasic-theme"
							),
							value: exclude,
							onChange: (v) => setAttributes({ exclude: v }),
						})
					),
					el(
						PanelBody,
						{
							title: __("Home link", "edwbasic-theme"),
							initialOpen: false,
						},
						el(ToggleControl, {
							label: __("Include Home link", "edwbasic-theme"),
							checked: includeHome,
							onChange: (v) => setAttributes({ includeHome: v }),
						}),
						includeHome &&
							el(TextControl, {
								label: __("Home label", "edwbasic-theme"),
								value: homeLabel,
								onChange: (v) =>
									setAttributes({ homeLabel: v }),
							})
					),
					el(
						PanelBody,
						{
							title: __("Brand / Logo", "edwbasic-theme"),
							initialOpen: true,
						},
						el(ToggleControl, {
							label: __("Show logo", "edwbasic-theme"),
							checked: showLogo,
							onChange: (v) => setAttributes({ showLogo: v }),
						}),
						showLogo &&
							el(SelectControl, {
								label: __("Brand position", "edwbasic-theme"),
								value: brandPosition,
								options: [
									{ label: "Left", value: "left" },
									{ label: "Right", value: "right" },
								],
								onChange: (v) =>
									setAttributes({ brandPosition: v }),
							}),
						showLogo &&
							el(
								MediaUploadCheck,
								null,
								el(MediaUpload, {
									onSelect: (m) =>
										setAttributes({
											logoId: m?.id || 0,
											logoUrl: m?.url || "",
											logoAlt: m?.alt || "",
										}),
									allowedTypes: ["image"],
									render: ({ open }) =>
										el(
											Button,
											{
												variant: "secondary",
												onClick: open,
											},
											logoId || logoUrl
												? __(
														"Change logo",
														"edwbasic-theme"
												  )
												: __(
														"Select logo",
														"edwbasic-theme"
												  )
										),
								})
							),
						(logoId || logoUrl) &&
							el(
								Button,
								{
									variant: "link",
									onClick: () =>
										setAttributes({
											logoId: 0,
											logoUrl: "",
											logoAlt: "",
										}),
								},
								__("Remove logo", "edwbasic-theme")
							),
						showLogo &&
							el(RangeControl, {
								label: __("Logo width (px)", "edwbasic-theme"),
								min: 40,
								max: 320,
								value: logoWidth,
								onChange: (v) =>
									setAttributes({ logoWidth: v }),
							}),
						showLogo &&
							el(TextControl, {
								label: __("Alt text", "edwbasic-theme"),
								value: logoAlt,
								onChange: (v) => setAttributes({ logoAlt: v }),
							}),
						showLogo &&
							el(ToggleControl, {
								label: __(
									"Link logo to home",
									"edwbasic-theme"
								),
								checked: logoLinkHome,
								onChange: (v) =>
									setAttributes({ logoLinkHome: v }),
							})
					)
				),

				// Live preview
				// el(ServerSideRender, { block: "edw/nav-pages", attributes })
				el(
					"div",
					blockProps,
					el(ServerSideRender, { block: "edw/nav-pages", attributes })
				)
			);
		},
		// Dynamic block: front-end is rendered by PHP
		save: () => null,
	});
})(window.wp);
