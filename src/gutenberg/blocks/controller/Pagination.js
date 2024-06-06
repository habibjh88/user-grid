import {__} from "@wordpress/i18n";
import {PanelBody, SelectControl} from '@wordpress/components';
import {Dimension, Color, Typography} from "../../components/Components";
import {BUTTON_STYLE, PAGINATION_STYLE} from "../../components/Constants";

export default function Pagination(props) {
    const {attributes, setAttributes} = props.data;
    //All attribute
    const {
        pagination_style,
        pagination_typography,
        pagination_spacing,
        pagination_color,
    } = attributes;

    return (
        <PanelBody title={__('Pagination', 'user-grid')} initialOpen={false}>

            <SelectControl
                label={__("Pagination Style", "user-grid")}
                className="dowp-control-field label-inline dowp-expand"
                value={pagination_style}
                options={PAGINATION_STYLE}
                onChange={(pagination_style) => {
                    setAttributes({pagination_style})
                    changeQuery()
                }}
            />

            <Typography
                label={__('Typography')}
                value={pagination_typography}
                onChange={(val) => setAttributes({pagination_typography: val})}
            />

            <Dimension
                label={__("Spacing", "user-grid")}
                type="margin" responsive
                value={pagination_spacing}
                onChange={(value) => {
                    setAttributes({pagination_spacing: value})
                    changeQuery()
                }}
            />

            <Color
                label={__('Color', 'user-grid')}
                color={pagination_color}
                onChange={(pagination_color) => setAttributes({pagination_color})}
            />

        </PanelBody>
    );
}
