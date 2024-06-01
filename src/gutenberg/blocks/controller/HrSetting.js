import {__} from "@wordpress/i18n";
import {PanelBody} from '@wordpress/components';
import {Dimension, Color, RangeDevice} from "../../components/Components";

export default function HrSetting(props) {
    const {attributes, setAttributes} = props.data;
    //All attribute
    const {
        hr1_spacing,
        hr1_color,
        hr1_width,
        hr1_height,
        hr1_radius,
        hr2_spacing,
        hr2_color,
        hr2_width,
        hr2_height
    } = attributes;

    return (
        <PanelBody title={__('Horizontal Line', 'user-grid')} initialOpen={false}>

            <h3 className={`dowp-controll-heading`}>{__("Horizontal 1")}</h3>

            <Dimension
                label={__("Spacing", "user-grid")}
                type="margin" responsive
                value={hr1_spacing}
                onChange={(value) => {
                    setAttributes({hr1_spacing: value})
                }}
            />

            <Color
                label={__('Color', 'user-grid')}
                color={hr1_color}
                onChange={(hr1_color) => setAttributes({hr1_color})}
            />

            <RangeDevice
                label={__('Width')}
                responsive={true}
                units={['px', '%']}
                value={hr1_width}
                min={0}
                max={100}
                step={1}
                onChange={(val) => setAttributes({hr1_width: val})}
            />

            <RangeDevice
                label={__('Height')}
                responsive={true}
                value={hr1_height}
                min={0}
                max={100}
                step={1}
                onChange={(val) => setAttributes({hr1_height: val})}
            />

            <RangeDevice
                label={__('Border Radius')}
                units={['px', '%']}
                value={hr1_radius}
                min={0}
                max={100}
                step={1}
                onChange={(val) => setAttributes({hr1_radius: val})}
            />

            <h3 className={`dowp-controll-heading`}>{__("Horizontal 2")}</h3>

            <Dimension
                label={__("Spacing", "user-grid")}
                type="margin" responsive
                value={hr2_spacing}
                onChange={(value) => {
                    setAttributes({hr2_spacing: value})
                }}
            />

            <Color
                label={__('Color', 'user-grid')}
                color={hr2_color}
                onChange={(hr2_color) => setAttributes({hr2_color})}
            />

            <RangeDevice
                label={__('Width')}
                responsive={true}
                value={hr2_width}
                units={['px', '%']}
                min={0}
                max={100}
                step={1}
                onChange={(val) => setAttributes({hr2_width: val})}
            />

            <RangeDevice
                label={__('Height')}
                responsive={true}
                value={hr2_height}
                min={0}
                max={100}
                step={1}
                onChange={(val) => setAttributes({hr2_height: val})}
            />

        </PanelBody>
    );
}
