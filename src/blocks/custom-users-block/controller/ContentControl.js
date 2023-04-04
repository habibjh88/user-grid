import Range from "../../../components/Range";

const {Spinner} = wp.components;
import TPGColumn from "../../../components/TPGColumn";
import {__experimentalHeading as Heading, __experimentalNumberControl as NumberControl} from '@wordpress/components';
import {SelectControl, PanelBody} from "@wordpress/components";
import Select from 'react-select';
import Dimension from "../../../components/Dimension";
import RangeDevice from "../../../components/RangeDevice";
import Alignment from "../../../components/Alignment";

const {__} = wp.i18n;
import {
    GRID_LAYOUT_OPT,
    LIST_LAYOUT_OPT,
    GRID_HOVER_LAYOUT_OPT,
    SLIDER_LAYOUT_OPT, FORMATE_USERS
} from "../../../components/Constants";
import * as PropTypes from "prop-types";


function ContentControl(props) {
    const {attributes, setAttributes, changeQuery, userData} = props.data;

    //All attribute
    const {
        grid_column,
        users_lists,
        grid_gap,
        image_size,
        grid_alignment
    } = attributes;

    const imageSizes = [...props.imageSizes];

    return (
        <PanelBody title={__('Category Block', 'the-post-grid')} initialOpen={true}>

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
                    {!userData.users && <Spinner/>}
                </label>

                <Select
                    options={FORMATE_USERS(userData.users)}
                    value={users_lists}
                    onChange={(value) => {
                        setAttributes({users_lists: value})
                        changeQuery()
                    }}
                    isMulti={true}
                    closeMenuOnSelect={true}
                    isClearable={false}
                />

            </div>


            <RangeDevice
                label={__('Grid Gap')}
                responsive={true}
                value={grid_gap}
                min={0}
                max={100}
                step={1}
                onChange={(val) => {
                    setAttributes({grid_gap: val})
                }}
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
                value={grid_alignment}
                // responsive={ true }
                onChange={grid_alignment => setAttributes({grid_alignment})}
            />


        </PanelBody>
    );
}

export default ContentControl;
