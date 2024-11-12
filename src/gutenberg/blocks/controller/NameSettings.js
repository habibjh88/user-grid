import {__} from "@wordpress/i18n";
import {SelectControl, PanelBody} from '@wordpress/components';
import {HEADING} from "../../components/Constants";
import {Dimension, Color, Typography} from "../../components/Components";

function NameSettings(props) {
    const {attributes, setAttributes} = props.data;
    //All attribute
    const {
        name_tag,
        name_typography,
        name_spacing,
        name_color,
        line_color,
        name_color_hover
    } = attributes;

    return (
        <PanelBody title={__('Name', 'user-grid')} initialOpen={false}>

            <SelectControl
                label={__('Name Tags', 'user-grid')}
                className="usgr-control-field label-inline"
                options={HEADING}
                value={name_tag}
                onChange={(name_tag) => setAttributes({name_tag})}
            />

            <Typography
                label={__('Typography')}
                value={name_typography}
                onChange={(val) => setAttributes({name_typography: val})}
            />

            <Dimension
                label={__("Spacing", "user-grid")}
                type="margin" responsive
                value={name_spacing}
                onChange={(value) => {
                    setAttributes({name_spacing: value})
                }}
            />

            <Color
                label={__('Color', 'user-grid')}
                color={name_color}
                onChange={(name_color) => setAttributes({name_color})}
            />

            <Color
                label={__('Color - Hover', 'user-grid')}
                color={name_color_hover}
                onChange={(name_color_hover) => setAttributes({name_color_hover})}
            />
            <Color
                label={__('Bottom Line Color', 'user-grid')}
                color={line_color}
                onChange={(line_color) => setAttributes({line_color})}
            />

        </PanelBody>
    );
}

export default NameSettings;
