import {
    PanelBody,
    ToggleControl,
    __experimentalBorderControl as BorderControl
} from "@wordpress/components";
import Dimension from "../../components/Dimension";

const {__} = wp.i18n;
import {UserGrid_COLOR_PALATE} from "../../components/Constants";
import Range from "../../components/Range";
import RangeDevice from "../../components/RangeDevice";
import Media from "../../components/Media";

function AvatarSettings(props) {
    const {attributes, setAttributes, changeQuery} = props.data;
    //All attribute
    const {
        avatar_dimension,
        avatar_width,
        default_image,
        avatar_height,
        avatar_border_radius,
        avatar_margin,
        avatar_border,
        image_link,
        avatar_position
    } = attributes;

    return (
        <PanelBody title={__('Image', 'user-grid')} initialOpen={false}>

            <ToggleControl
                label={__("Enable Image Link", "user-grid")}
                className="dowp-toggle-control-field"
                checked={image_link}
                onChange={(image_link) => setAttributes({image_link: image_link ? 'yes' : ''})}
            />

            <Media
                label={__("Default Image", "user-grid")}
                multiple={false}
                type={['image']}
                panel={true}
                value={default_image}
                onChange={val => {
                    setAttributes({default_image: val})
                    changeQuery()
                }}
            />

            <Range
                label={__("Gravatar Size")}
                value={avatar_dimension}
                onChange={(val) => {
                    setAttributes({avatar_dimension: val})
                    changeQuery()
                }}
                min={50}
                max={1000}
                step={1}
            />
            <small className="dowp-help">{__("Avatar Dimension works only for gravatar", "user-grid")}</small>

            <RangeDevice
                label={__('Image Width')}
                responsive={true}
                value={avatar_width}
                min={0}
                max={500}
                step={1}
                onChange={(val) => setAttributes({avatar_width: val})}
            />

            <RangeDevice
                label={__('Image Height')}
                responsive={true}
                value={avatar_height}
                min={0}
                max={500}
                step={1}
                onChange={(val) => setAttributes({avatar_height: val})}
            />

            <RangeDevice
                label={__('Image Y Position (Optional)')}
                responsive={true}
                unit='%'
                value={avatar_position}
                min={-100}
                max={100}
                step={1}
                onChange={(val) => setAttributes({avatar_position: val})}
            />

            <Dimension
                label={__("Avatar Border Radius", "user-grid")}
                className={`dowp-dimension-wrap`}
                type="borderRadius" responsive
                value={avatar_border_radius}
                onChange={(value) => {
                    setAttributes({avatar_border_radius: value})
                }}
            />

            <Dimension
                label={__("Image Margin", "user-grid")}
                className={`dowp-dimension-wrap`}
                type="margin" responsive
                value={avatar_margin}
                onChange={(value) => {
                    setAttributes({avatar_margin: value})
                }}
            />

            <BorderControl
                colors={UserGrid_COLOR_PALATE}
                value={avatar_border}
                label={__("Image Border", "user-grid")}
                onChange={(val) => {
                    const newVal = {openTpgBorder: 1, ...val}
                    setAttributes({avatar_border: newVal})
                }}
                withSlider
            />

        </PanelBody>
    );
}

export default AvatarSettings;
