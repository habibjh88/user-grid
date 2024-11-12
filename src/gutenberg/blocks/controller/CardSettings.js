import {
    PanelBody,
    __experimentalBorderControl as BorderControl, ToggleControl
} from '@wordpress/components';
import {UserGrid_COLOR_PALATE} from "../../components/Constants";
import {Dimension, RangeDevice, Background, BoxShadow} from "../../components/Components";
import {__} from "@wordpress/i18n";

function CardSettings(props) {
    const {attributes, setAttributes, changeQuery} = props.data;
    //All attribute
    const {
        layout,
        card_gap,
        card_min_height,
        card_padding,
        content_padding,
        card_bg,
        card_border,
        card_radius,
        card_box_shadow,
        lift_box_hover
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

            {['grid13', 'grid14', 'grid15', 'slider13', 'slider14', 'slider15'].includes(layout) &&
                <RangeDevice
                    label={__('Card Min Height')}
                    responsive={true}
                    value={card_min_height}
                    min={200}
                    max={1024}
                    step={10}
                    onChange={(val) => setAttributes({card_min_height: val})}
                />
            }

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
                className={`usgr-dimension-wrap`}
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

            <ToggleControl
                label={__("Lift Box on Hover", "user-grid")}
                className="usgr-toggle-control-field"
                checked={lift_box_hover}
                onChange={(lift_box_hover) => {
                    setAttributes({lift_box_hover: lift_box_hover ? 'lift-on-hover' : ''});
                    changeQuery();
                }}
            />
        </PanelBody>
    );
}

export default CardSettings;
