const {Spinner} = wp.components;
import GridColumn from "../../../components/GridColumn";
import {
    __experimentalHeading as Heading,
    __experimentalNumberControl as NumberControl, TextControl,
    ToggleControl
} from '@wordpress/components';
import {SelectControl, PanelBody} from "@wordpress/components";
import Select from 'react-select';
// import AsyncSelect from 'react-select/async';
import Alignment from "../../../components/Alignment";
import Layouts from "../../../components/Styles";

const {__} = wp.i18n;
import {
    FORMATE_USERS, USER_ORDER_BY, POST_SORT_ORDER, GRID_LAYOUT_OPT
} from "../../../components/Constants";


function ContentControl(props) {
    const {attributes, setAttributes, changeQuery, userData} = props.data;

    //All attribute
    const {
        layout,
        grid_column,
        users_lists,
        user_limit,
        users_role,
        user_filter_by_domain,
        grid_alignment,
        avatar_visibility,
        name_visibility,
        email_visibility,
        designation_visibility,
        bio_visibility,
        social_visibility,
        orderby,
        order,
        role_in,
        grid_style
    } = attributes;

    return (
        <div className={`components-panel__body is-opened`}>

            <Heading className="gtusers-control-heading">{__("layout", "gutenberg-users")}</Heading>

            <Layouts
                value={layout}
                onChange={val => setAttributes({layout: val})}
                options={GRID_LAYOUT_OPT}
            />

            <Heading className="gtusers-control-heading">{__("Query", "gutenberg-users")}</Heading>

            <div className="components-base-control gtusers-repeater">
                <label
                    className="components-base-control__label components-input-control__label"
                    htmlFor="react-select-2-input">
                    {__('Choose Users', 'gutenberg-users')}
                    {!userData.users && <Spinner/>}
                </label>

                <Select
                    options={FORMATE_USERS(userData.users, 'email')}
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

            <div className="components-base-control gtusers-repeater">
                <label
                    className="components-base-control__label components-input-control__label"
                    htmlFor="react-select-2-input">
                    {__('Users Role', 'gutenberg-users')}
                    {!userData.roles && <Spinner/>}
                </label>

                <Select
                    options={FORMATE_USERS(userData.roles)}
                    value={users_role}
                    onChange={(value) => {
                        setAttributes({users_role: value})
                        changeQuery()
                    }}
                    isMulti={true}
                    closeMenuOnSelect={true}
                    isClearable={false}
                />
            </div>

            <TextControl
                autocomplete="off"
                help="Search by E-mail keywords, Eg. your-company.com"
                label="Filter by email domain"
                value={user_filter_by_domain}
                placeholder="Eg. @website.com, @inof.com etc"
                onChange={(user_filter_by_domain) => {
                    setAttributes({user_filter_by_domain})
                    changeQuery();
                }}
            />

            <NumberControl
                isShiftStepEnabled
                label={__("User Limit", "gutenberg-users")}
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

            <small
                className="gtusers-help">{__("The number of users to show. Enter -1 to show all found posts.", "gutenberg-users")}</small>

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


            <GridColumn
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

            <SelectControl
                label={__("Style", "gutenberg-users")}
                className="gtusers-control-field label-inline gtusers-expand"
                value={grid_style}
                options={[
                    {value: 'grid-style', label: __('Grid', 'gutenberg-users')},
                    {value: 'list-style', label: __('List', 'gutenberg-users')}
                ]}
                onChange={(grid_style) => {
                    setAttributes({grid_style})
                }}
            />

            <SelectControl
                label={__("Role In", "gutenberg-users")}
                className="gtusers-control-field label-inline gtusers-expand"
                value={role_in}
                options={[
                    {value: 'grid-style', label: __('Grid', 'gutenberg-users')},
                    {value: 'list-style', label: __('List', 'gutenberg-users')}
                ]}
                onChange={(role_in) => {
                    setAttributes({role_in})
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
                label={__("Show Designation", "gutenberg-users")}
                className="gtusers-toggle-control-field"
                checked={designation_visibility}
                onChange={(designation_visibility) => setAttributes({designation_visibility: designation_visibility ? 'show' : ''})}
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

        </div>
    );
}

export default ContentControl;