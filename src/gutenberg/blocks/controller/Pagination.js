import {__} from "@wordpress/i18n";
import {
    __experimentalNumberControl as NumberControl,
    PanelBody,
    SelectControl,
    TextControl
} from '@wordpress/components';
import {Dimension, Color, Typography, Alignment, CustomSelect} from "../../components/Components";
import {BUTTON_STYLE, PAGINATION_STYLE, PAGINATION_TYPE} from "../../components/Constants";

export default function Pagination(props) {
    const {attributes, setAttributes, changeQuery} = props.data;
    //All attribute
    const {
        pagination_type,
        load_more_label,
        prev_label,
        next_label,
        pagination_style,
        pagination_alignment,
        pagination_typography,
        pagination_spacing,
        pagination_color,
        pagination_gap
    } = attributes;

    return (
        <PanelBody title={__('Pagination', 'user-grid')} initialOpen={false}>
            <CustomSelect
                label={__("Type", "user-grid")}
                className="dowp-control-field label-inline dowp-expand"
                value={pagination_type}
                options={PAGINATION_TYPE}
                onChange={val => {
                    setAttributes({pagination_type: val});
                    changeQuery();
                }}
            />
            {'load-more-pgn' !== pagination_type &&
                <>
                    <TextControl
                        autocomplete="off"
                        label={__("Prev label", "user-grid")}
                        value={prev_label}
                        placeholder="Prev"
                        onChange={(prev_label) => {
                            setAttributes({prev_label})
                            changeQuery();
                        }}
                    />
                    <TextControl
                        autocomplete="off"
                        label={__("Next label", "user-grid")}
                        value={next_label}
                        placeholder="Next"
                        onChange={(next_label) => {
                            setAttributes({next_label})
                            changeQuery();
                        }}
                    />
                </>
            }
            {'load-more-pgn' === pagination_type &&
                <TextControl
                    autocomplete="off"
                    label={__("Load More label", "user-grid")}
                    value={load_more_label}
                    placeholder="Eg. Load More"
                    onChange={(load_more_label) => {
                        setAttributes({load_more_label})
                        changeQuery();
                    }}
                />
            }
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

            <h3 className={`dowp-controll-heading`}>{__("Style")}</h3>

            <Alignment
                label={__("Alignment", "user-grid")}
                options={['left', 'center', 'right']}
                value={pagination_alignment}
                responsive
                onChange={pagination_alignment => {
                    setAttributes({pagination_alignment})
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

            <NumberControl
                isShiftStepEnabled
                label={__("Item Gap (px)", "user-grid")}
                max={100}
                min={0}
                value={pagination_gap}
                onChange={(pagination_gap) => {
                    setAttributes({pagination_gap})
                }}
                placeholder={__("Eg. 10", "user-grid")}
                shiftStep={10}
                step="1"
                className="dowp-control-field label-inline"
            />

            <Color
                label={__('Color', 'user-grid')}
                color={pagination_color}
                onChange={(pagination_color) => setAttributes({pagination_color})}
            />

        </PanelBody>
    );
}
