const {Spinner} = wp.components;
import TPGColumn from "../../../components/TPGColumn";
import {
    __experimentalHeading as Heading,
    __experimentalNumberControl as NumberControl,
    ToggleControl
} from '@wordpress/components';
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
    SLIDER_LAYOUT_OPT, FORMATE_USERS, HEADING
} from "../../../components/Constants";
import * as PropTypes from "prop-types";


function ContentControl(props) {
    const {attributes, setAttributes, changeQuery, userData} = props.data;

    //All attribute
    const {
        grid_column,
        users_lists,
        grid_gap,
        grid_alignment,
        avatar_visibility,
        name_visibility,
        bio_visibility
    } = attributes;

    return (
        <PanelBody title={__('Custom Users Block', 'the-post-grid')} initialOpen={true}>

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

            <Alignment
                label={__("Alignment", "the-post-grid")}
                options={['left', 'center', 'right']}
                value={grid_alignment}
                // responsive={ true }
                onChange={grid_alignment => setAttributes({grid_alignment})}
            />


            <Heading className="rttpg-control-heading">{__("Field Visibility", "the-post-grid")}</Heading>

            <ToggleControl
                label={__("Show Avatar", "the-post-grid")}
                className="rttpg-toggle-control-field"
                checked={avatar_visibility}
                onChange={(avatar_visibility) => setAttributes({avatar_visibility: avatar_visibility ? 'show' : ''})}
            />

            <ToggleControl
                label={__("Show Name", "the-post-grid")}
                className="rttpg-toggle-control-field"
                checked={name_visibility}
                onChange={(name_visibility) => setAttributes({name_visibility: name_visibility ? 'show' : ''})}
            />

            <ToggleControl
                label={__("Show Biography", "the-post-grid")}
                className="rttpg-toggle-control-field"
                checked={bio_visibility}
                onChange={(bio_visibility) => setAttributes({bio_visibility: bio_visibility ? 'show' : ''})}
            />


        </PanelBody>
    );
}

export default ContentControl;