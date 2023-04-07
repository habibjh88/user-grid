const {Spinner} = wp.components;
import TPGColumn from "../../../components/TPGColumn";
import {
    __experimentalHeading as Heading,
    __experimentalNumberControl as NumberControl, TextControl,
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
    SLIDER_LAYOUT_OPT, FORMATE_USERS, HEADING, USER_ORDER_BY, POST_SORT_ORDER
} from "../../../components/Constants";
import * as PropTypes from "prop-types";


function ContentControl(props) {
    const {attributes, setAttributes, changeQuery, userData} = props.data;

    //All attribute
    const {
        grid_column,
        users_lists,
        user_limit,
        user_filter_by_domain,
        grid_gap,
        grid_alignment,
        avatar_visibility,
        name_visibility,
        email_visibility,
        bio_visibility,
        social_visibility,
        orderby,
        order
    } = attributes;

    return (
        <PanelBody title={__('Custom Users Block', 'gutenberg-users')} initialOpen={true}>

            <Heading className="gtusers-control-heading">{__("Query", "gutenberg-users")}</Heading>

            <div className="components-base-control gtusers-repeater">
                <label
                    className="components-base-control__label components-input-control__label"
                    htmlFor="react-select-2-input">
                    {__('Choose Users', 'gutenberg-users')}
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

            <TextControl
                autocomplete="off"
                help="This filter won't work if you choose users from (Choose Users)"
                label="Filter by email domain"
                value={user_filter_by_domain}
                onChange={(user_filter_by_domain) => {
                    setAttributes({user_filter_by_domain})
                    changeQuery();
                }}
            />

            <NumberControl
                isShiftStepEnabled
                label={__("User Limit", "gutenberg-users")}
                help={__("The number of users to show. Enter -1 to show all found posts.", "gutenberg-users")}
                max={1000}
                min={-1}
                value={user_limit}
                onChange={(user_limit) => {
                    setAttributes({user_limit})
                    changeQuery()
                }}
                placeholder={__("Eg. 10", "gutenberg-users")}
                shiftStep={10}
                step="1"
                className="gtusers-control-field label-inline"
            />

            <SelectControl
                label={__("Order By", "gutenberg-users")}
                className="gtusers-control-field label-inline gtusers-expand"
                value={orderby}
                options={USER_ORDER_BY}
                onChange={(orderby) => {
                    setAttributes({orderby})
                    changeQuery()
                }}
            />

            <SelectControl
                label={__("Sort Order", "gutenberg-users")}
                className="gtusers-control-field label-inline gtusers-expand"
                value={order}
                options={POST_SORT_ORDER}
                onChange={(order) => {
                    setAttributes({order})
                    changeQuery()
                }}
            />


            <TPGColumn
                label={__("Grid Column", "gutenberg-users")}
                className="gtusers-control-field"
                value={grid_column}
                onChange={(grid_column) => {
                    setAttributes({grid_column})
                }}
                colStyle="grid"
                changeQuery={changeQuery}
            />

            <Heading className="gtusers-control-heading">{__("Layouts", "gutenberg-users")}</Heading>


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
                label={__("Alignment", "gutenberg-users")}
                options={['left', 'center', 'right']}
                value={grid_alignment}
                // responsive={ true }
                onChange={grid_alignment => setAttributes({grid_alignment})}
            />


            <Heading className="gtusers-control-heading">{__("Field Visibility", "gutenberg-users")}</Heading>

            <ToggleControl
                label={__("Show Avatar", "gutenberg-users")}
                className="gtusers-toggle-control-field"
                checked={avatar_visibility}
                onChange={(avatar_visibility) => setAttributes({avatar_visibility: avatar_visibility ? 'show' : ''})}
            />

            <ToggleControl
                label={__("Show Name", "gutenberg-users")}
                className="gtusers-toggle-control-field"
                checked={name_visibility}
                onChange={(name_visibility) => setAttributes({name_visibility: name_visibility ? 'show' : ''})}
            />

            <ToggleControl
                label={__("Show Email", "gutenberg-users")}
                className="gtusers-toggle-control-field"
                checked={email_visibility}
                onChange={(email_visibility) => setAttributes({email_visibility: email_visibility ? 'show' : ''})}
            />

            <ToggleControl
                label={__("Show Biography", "gutenberg-users")}
                className="gtusers-toggle-control-field"
                checked={bio_visibility}
                onChange={(bio_visibility) => setAttributes({bio_visibility: bio_visibility ? 'show' : ''})}
            />


            <ToggleControl
                label={__("Show Social Icon", "gutenberg-users")}
                className="gtusers-toggle-control-field"
                checked={social_visibility}
                onChange={(social_visibility) => setAttributes({social_visibility: social_visibility ? 'show' : ''})}
            />


        </PanelBody>
    );
}

export default ContentControl;