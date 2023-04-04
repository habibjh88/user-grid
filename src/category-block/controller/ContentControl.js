import TPGColumn from "../../../../../the-post-grid/src/components/TPGColumn";
import {__experimentalHeading as Heading} from '@wordpress/components';
import {SelectControl, PanelBody} from "@wordpress/components";
import Select from 'react-select';
import Dimension from "../../../../../the-post-grid/src/components/Dimension";
import RangeDevice from "../../../../../the-post-grid/src/components/RangeDevice";
import Alignment from "../../../../../the-post-grid/src/components/Alignment";

const {__} = wp.i18n;
import {
    GRID_LAYOUT_OPT,
    LIST_LAYOUT_OPT,
    GRID_HOVER_LAYOUT_OPT,
    SLIDER_LAYOUT_OPT, PRINT_TAXONOMY
} from "../../../../../the-post-grid/src/components/Constants";
import * as PropTypes from "prop-types";


function ContentControl(props) {
    const {attributes, setAttributes, changeQuery} = props.data;

    //All attribute
    const {
        grid_column,
        category_lists,
        cat_gap,
        cat_color,
        image_size,
        category_alignment
    } = attributes;

    const imageSizes = [...props.imageSizes];

    const allTermList = rttpgParams.all_term_list;

    return (
        <PanelBody title={__('Category Block', 'the-post-grid')} initialOpen={true}>

            <Heading className="rttpg-control-heading">{__("Layout Options:", "the-post-grid")}</Heading>

            <TPGColumn
                label={__("Grid Column", "the-post-grid")}
                className="rttpg-control-field"
                value={grid_column}
                onChange={(grid_column) => {
                    setAttributes({grid_column})
                }}
                colStyle="grid"
                changeQuery={changeQuery}
            />

            <div className="components-base-control rttpg-repeater">
                <label
                    className="components-base-control__label components-input-control__label"
                    htmlFor="react-select-2-input">
                    {__('Choose Category', 'the-post-grid')}
                </label>

                <Select
                    options={PRINT_TAXONOMY(allTermList['category'])}
                    value={category_lists}
                    onChange={(value) => {
                        setAttributes({category_lists: value})
                        changeQuery()
                    }}
                    isMulti={true}
                    closeMenuOnSelect={true}
                    isClearable={false}
                />

            </div>

           {/*
           <Dimension
                label={__("Grid Gap", "the-post-grid")}
                type="padding"
                responsive
                value={cat_gap}
                onChange={(value) => {
                    setAttributes({cat_gap: value})
                }}
            />
            */}

            <RangeDevice
                label={__('Grid Gap')}
                responsive={true}
                value={cat_gap}
                min={0}
                max={100}
                step={1}
                onChange={(val) => setAttributes({cat_gap: val})}
            />

            <SelectControl
                label={__("Image Size", "the-post-grid")}
                className="rttpg-control-field"
                options={imageSizes}
                value={image_size}
                onChange={(image_size) => {
                    setAttributes({image_size})
                    changeQuery()
                }}
            />

            <Alignment
                label={__("Alignment", "the-post-grid")}
                options={['left', 'center', 'right']}
                value={category_alignment}
                // responsive={ true }
                onChange={category_alignment => setAttributes({category_alignment})}
            />


        </PanelBody>
    );
}

export default ContentControl;
