import {
    PanelBody,
    __experimentalBorderControl as BorderControl
} from '@wordpress/components';
import {UserGrid_COLOR_PALATE} from "../../components/Constants";
import { Dimension, RangeDevice, Background, BoxShadow } from "../../components/Components";
import {__} from "@wordpress/i18n";

function CardSettings(props) {
    const {attributes, setAttributes, changeQuery} = props.data;
    //All attribute
    const {
        card_gap,
        card_padding,
        content_padding,
        card_bg,
        card_border,
        card_radius,
        card_box_shadow,
    } = attributes;

    return (
        <PanelBody title={__('Card Settings', 'user-grid')} initialOpen={false}>

          <RangeDevice
                label={__('Card Gap')}
                responsive={true}
                value={card_gap}
                min={0}
                max={100}
                step={1}
                onChange={(val) => {
                    setAttributes({card_gap: val})
                }}
            />

            <Dimension
                label={__("Card Padding", "user-grid")}
                type="padding" responsive
                value={card_padding}
                onChange={(value) => {
                    setAttributes({card_padding: value})
                }}
            />

            <Dimension
                label={__("Content Padding", "user-grid")}
                type="padding" responsive
                value={content_padding}
                onChange={(value) => {
                    setAttributes({content_padding: value})
                }}
            />

            <Dimension
                label={__("Card Radius", "user-grid")}
                className={`dowp-dimension-wrap`}
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
                colors={UserGrid_COLOR_PALATE}
                value={card_border}
                label={__("Card Border", "user-grid")}
                onChange={(val) => {
                    const newVal = {openTpgBorder: 1, ...val}
                    setAttributes({card_border: newVal})
                }}
                withSlider
            />

            <BoxShadow
                label={__('Box Shadow', 'the-post-grid')}
                value={card_box_shadow}
                onChange={val => setAttributes({card_box_shadow: val})}
            />

        </PanelBody>
    );
}

export default CardSettings;
