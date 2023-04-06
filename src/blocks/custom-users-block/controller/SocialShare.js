import {
    __experimentalBorderControl as BorderControl,
    Button,
    ToggleControl,
    SelectControl,
    PanelBody,
    Dropdown, __experimentalHeading as Heading
} from '@wordpress/components';
import Color from "../../../components/Color";
import Typography from "../../../components/Typography";
import Dimension from "../../../components/Dimension";
import RangeDevice from "../../../components/RangeDevice";

const {__} = wp.i18n

function SocialShare(props) {
    const {attributes, setAttributes} = props.data;
    //All attribute
    const {
        icon_font_size,
        social_spacing,
        social_color,
        social_color_hover,
    } = attributes;

    return (
        <PanelBody title={__('User Name', 'the-post-grid')} initialOpen={false}>

            <RangeDevice
                label={__('Icon Size')}
                responsive={true}
                value={icon_font_size}
                min={0}
                max={100}
                step={1}
                onChange={(val) => setAttributes({icon_font_size: val})}
            />

            <Dimension
                label={__("Spacing", "the-post-grid")}
                type="margin" responsive
                value={social_spacing}
                onChange={(value) => {
                    setAttributes({social_spacing: value})
                }}
            />

            <Color
                label={__('Color', 'the-post-grid')}
                color={social_color}
                onChange={(social_color) => setAttributes({social_color})}
            />

            <Color
                label={__('Color - Hover', 'the-post-grid')}
                color={social_color_hover}
                onChange={(social_color_hover) => setAttributes({social_color_hover})}
            />

        </PanelBody>
    );
}

export default SocialShare;
