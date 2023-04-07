import {__experimentalBorderControl as BorderControl, PanelBody} from "@wordpress/components";
import Dimension from "../../../../../the-post-grid/src/components/Dimension";
import RangeDevice from "../../../../../the-post-grid/src/components/RangeDevice";
const {__} = wp.i18n;
import {TPG_COLOR_PALATE} from "../../../../../the-post-grid/src/components/Constants";

function ImageStyle(props) {
    const {attributes, setAttributes} = props.data;
    //All attribute
    const {
        image_width,
        image_height,
        image_border_radius,
        image_border
    } = attributes;

    return (
        <PanelBody title={__('Image Style', 'gutenberg-users')} initialOpen={false}>
            <RangeDevice
                label={__('Image Width')}
                responsive={true}
                value={image_width}
                min={0}
                max={500}
                step={1}
                onChange={(val) => setAttributes({image_width: val})}
            />

            <RangeDevice
                label={__('Image Height')}
                responsive={true}
                value={image_height}
                min={0}
                max={500}
                step={1}
                onChange={(val) => setAttributes({image_height: val})}
            />

            <Dimension
                label={__("Image Border Radius", "gutenberg-users")}
                className={`gtusers-dimension-wrap`}
                type="borderRadius" responsive
                value={image_border_radius}
                onChange={(value) => {
                    setAttributes({image_border_radius: value})
                }}
            />

            <BorderControl
                colors={TPG_COLOR_PALATE}
                value={image_border}
                label={__("Image Border", "gutenberg-users")}
                onChange={(val) => {
                    const newVal = {openTpgBorder: 1, ...val}
                    setAttributes({image_border: newVal})
                }}
                withSlider
            />

        </PanelBody>
    );
}

export default ImageStyle;
