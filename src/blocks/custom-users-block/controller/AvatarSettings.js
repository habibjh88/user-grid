import {
    PanelBody,
    ToggleControl,
    __experimentalBorderControl as BorderControl
} from "@wordpress/components";
import Dimension from "../../../components/Dimension";

const {__} = wp.i18n;
import {GTUSERS_COLOR_PALATE} from "../../../components/Constants";
import Range from "../../../components/Range";
import RangeDevice from "../../../components/RangeDevice";
import Media from "../../../components/Media";

function AvatarSettings(props) {
    const {attributes, setAttributes, changeQuery} = props.data;
    //All attribute
    const {
        avatar_dimension,
        avatar_width,
        default_image,
        avatar_height,
        avatar_border_radius,
        avatar_border,
        image_link
    } = attributes;

    return (
        <PanelBody title={__('Avatar', 'gutenberg-users')} initialOpen={true}>

            <ToggleControl
                label={__("Enable Image Link", "gutenberg-users")}
                className="gtusers-toggle-control-field"
                checked={image_link}
                onChange={(image_link) => setAttributes({image_link: image_link ? 'yes' : ''})}
            />

            <Range
                label={__("Avatar Dimension")}
                value={avatar_dimension}
                onChange={(val) => {
                    setAttributes({avatar_dimension: val})
                    changeQuery()
                }}
                min={50}
                max={1000}
                step={1}
            />

            <small className="gtusers-help">{__("Avatar Dimension works only for wp avatar.", "gutenberg-users")}</small>

            <Media
                label={__("Default Image", "gutenberg-users")}
                multiple={false}
                type={['image']}
                panel={true}
                value={default_image}
                onChange={val => {
                    setAttributes({default_image: val})
                    changeQuery()
                }}
            />

            <hr/>

            <RangeDevice
                label={__('Img Wrap Width')}
                responsive={true}
                value={avatar_width}
                min={0}
                max={500}
                step={1}
                onChange={(val) => setAttributes({avatar_width: val})}
            />

            <RangeDevice
                label={__('Img Wrap Height')}
                responsive={true}
                value={avatar_height}
                min={0}
                max={500}
                step={1}
                onChange={(val) => setAttributes({avatar_height: val})}
            />

            <Dimension
                label={__("Avatar Border Radius", "gutenberg-users")}
                className={`gtusers-dimension-wrap`}
                type="borderRadius" responsive
                value={avatar_border_radius}
                onChange={(value) => {
                    setAttributes({avatar_border_radius: value})
                }}
            />

            <BorderControl
                colors={GTUSERS_COLOR_PALATE}
                value={avatar_border}
                label={__("Image Border", "gutenberg-users")}
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
