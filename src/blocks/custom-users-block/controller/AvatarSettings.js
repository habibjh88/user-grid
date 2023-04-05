import {
    SelectControl,
    PanelBody,
    __experimentalHeading as Heading,
    ToggleControl,
    __experimentalBorderControl as BorderControl
} from "@wordpress/components";
import Color from "../../../components/Color";
import Typography from "../../../components/Typography";
import Dimension from "../../../components/Dimension";

const {__} = wp.i18n;
import {HEADING, TPG_COLOR_PALATE} from "../../../components/Constants";
import Range from "../../../components/Range";
import RangeDevice from "../../../components/RangeDevice";

function AvatarSettings(props) {
    const {attributes, setAttributes, changeQuery} = props.data;
    //All attribute
    const {
        avatar_visibility,
        avatar_dimension,
        avatar_width,
        avatar_height,
        avatar_border_radius,
        avatar_border
    } = attributes;

    return (
        <PanelBody title={__('Category Style', 'the-post-grid')} initialOpen={true}>
            {/*<Heading className="rttpg-control-heading">{__("Settings:", "the-post-grid")}</Heading>*/}

            <ToggleControl
                label={__("Visibility", "the-post-grid")}
                className="rttpg-toggle-control-field"
                checked={avatar_visibility}
                onChange={(avatar_visibility) => setAttributes({avatar_visibility: avatar_visibility ? 'show' : ''})}
            />

            <Heading className="rttpg-control-heading">{__("Style:", "the-post-grid")}</Heading>

            <Range
                label={__("Image Dimension")}
                value={avatar_dimension}
                onChange={(val) => {
                    setAttributes({avatar_dimension: val})
                    changeQuery()
                }}
                min={50}
                max={1000}
                step={1}
            />

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
                label={__("Avatar Border Radius", "the-post-grid")}
                className={`rttpg-dimension-wrap`}
                type="borderRadius" responsive
                value={avatar_border_radius}
                onChange={(value) => {
                    setAttributes({avatar_border_radius: value})
                }}
            />

            <BorderControl
                colors={TPG_COLOR_PALATE}
                value={avatar_border}
                label={__("Image Border", "the-post-grid")}
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
