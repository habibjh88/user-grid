import {
    PanelBody,
    __experimentalBorderControl as BorderControl
} from '@wordpress/components';
import Dimension from "../../../components/Dimension";
import Background from "../../../components/Background";
import {GTUSERS_COLOR_PALATE} from "../../../components/Constants";

const {__} = wp.i18n;

function CardSettings(props) {
    const {attributes, setAttributes} = props.data;
    //All attribute
    const {
        card_padding,
        content_padding,
        card_bg,
        card_border,
        card_radius
    } = attributes;

    return (
        <PanelBody title={__('Card Settings', 'gutenberg-users')} initialOpen={false}>

            <Dimension
                label={__("Card Padding", "gutenberg-users")}
                type="margin" responsive
                value={card_padding}
                onChange={(value) => {
                    setAttributes({card_padding: value})
                }}
            />

            <Dimension
                label={__("Content Padding", "gutenberg-users")}
                type="padding" responsive
                value={content_padding}
                onChange={(value) => {
                    setAttributes({content_padding: value})
                }}
            />

            <Dimension
                label={__("Avatar Border Radius", "gutenberg-users")}
                className={`gtusers-dimension-wrap`}
                type="borderRadius" responsive
                value={card_radius}
                onChange={(value) => {
                    setAttributes({card_radius: value})
                }}
            />


            <Background
                image={false}
                label={__("Card Background", "the-post-grid")}
                value={card_bg}
                onChange={val => setAttributes({card_bg: val})}
            />

            <BorderControl
                colors={GTUSERS_COLOR_PALATE}
                value={card_border}
                label={__("Card Border", "gutenberg-users")}
                onChange={(val) => {
                    const newVal = {openTpgBorder: 1, ...val}
                    setAttributes({card_border: newVal})
                }}
                withSlider
            />

        </PanelBody>
    );
}

export default CardSettings;
