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
import Sortable from "../../../components/Sortable";

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
        orderby,
        order,
        role_in,
        grid_style,
        content_order
    } = attributes;


    return (
        <div className={`components-panel__body is-opened`}>

            <Heading className="dowp-control-heading">{__("layout", "user-grid")}</Heading>

            <Layouts
                value={layout}
                onChange={val => setAttributes({layout: val})}
                options={GRID_LAYOUT_OPT}
            />

            <Heading className="dowp-control-heading">{__("Query", "user-grid")}</Heading>

            <div className="components-base-control dowp-repeater">
                <label
                    className="components-base-control__label components-input-control__label"
                    htmlFor="react-select-2-input">
                    {__('Choose Users', 'user-grid')}
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

            <div className="components-base-control dowp-repeater">
                <label
                    className="components-base-control__label components-input-control__label"
                    htmlFor="react-select-2-input">
                    {__('Users Role', 'user-grid')}
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
                label={__("User Limit", "user-grid")}
                max={1000}
                min={-1}
                value={user_limit}
                onChange={(user_limit) => {
                    setAttributes({user_limit})
                    changeQuery()
                }}
                placeholder={__("Eg. 10", "user-grid")}
                shiftStep={10}
                step="1"
                className="dowp-control-field label-inline"
            />

            <small
                className="dowp-help">{__("The number of users to show. Enter -1 to show all found posts.", "user-grid")}</small>

            <SelectControl
                label={__("Order By", "user-grid")}
                className="dowp-control-field label-inline dowp-expand"
                value={orderby}
                options={USER_ORDER_BY}
                onChange={(orderby) => {
                    setAttributes({orderby})
                    changeQuery()
                }}
            />

            <SelectControl
                label={__("Sort Order", "user-grid")}
                className="dowp-control-field label-inline dowp-expand"
                value={order}
                options={POST_SORT_ORDER}
                onChange={(order) => {
                    setAttributes({order})
                    changeQuery()
                }}
            />


            <GridColumn
                label={__("Grid Column", "user-grid")}
                className="dowp-control-field"
                value={grid_column}
                onChange={(grid_column) => {
                    setAttributes({grid_column})
                }}
                colStyle="grid"
                changeQuery={changeQuery}
            />

            <Heading className="dowp-control-heading">{__("Layouts", "user-grid")}</Heading>

            <SelectControl
                label={__("Style", "user-grid")}
                className="dowp-control-field label-inline dowp-expand"
                value={grid_style}
                options={[
                    {value: 'grid-style', label: __('Grid', 'user-grid')},
                    {value: 'list-style', label: __('List', 'user-grid')}
                ]}
                onChange={(grid_style) => {
                    setAttributes({grid_style})
                }}
            />

            <SelectControl
                label={__("Role In", "user-grid")}
                className="dowp-control-field label-inline dowp-expand"
                value={role_in}
                options={[
                    {value: 'grid-style', label: __('Grid', 'user-grid')},
                    {value: 'list-style', label: __('List', 'user-grid')}
                ]}
                onChange={(role_in) => {
                    setAttributes({role_in})
                }}
            />

            <Alignment
                label={__("Alignment", "user-grid")}
                options={['left', 'center', 'right']}
                value={grid_alignment}
                onChange={grid_alignment => setAttributes({grid_alignment})}
            />

            <hr/>

            <Sortable
                value={content_order}
                onChange={val => setAttributes({content_order: val})}
                label={"Sort Content"}
            />

        </div>
    );
}

export default ContentControl;