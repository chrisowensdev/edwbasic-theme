import { useBlockProps, RichText } from "@wordpress/block-editor";

export default function save({ attributes }) {
	const { eyebrow, headline, subcopy, ctaText, ctaUrl, bgUrl } = attributes;
	const blockProps = useBlockProps.save({
		className: "edw-hero",
		style: bgUrl ? { backgroundImage: `url(${bgUrl})` } : {},
	});

	return (
		<section {...blockProps}>
			<div className="edw-hero__inner">
				{eyebrow && (
					<RichText.Content
						tagName="p"
						className="edw-hero__eyebrow"
						value={eyebrow}
					/>
				)}
				{headline && (
					<RichText.Content
						tagName="h1"
						className="edw-hero__headline"
						value={headline}
					/>
				)}
				{subcopy && (
					<RichText.Content
						tagName="div"
						className="edw-hero__subcopy"
						value={subcopy}
					/>
				)}
				{ctaText ||
					(ctaUrl && (
						<p className="edw-hero__cta">
							<a className="wp-block-button__link" href={ctaUrl}>
								{ctaText}
							</a>
						</p>
					))}
			</div>
		</section>
	);
}
