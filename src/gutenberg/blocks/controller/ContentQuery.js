import {__} from "@wordpress/i18n";
import {__experimentalNumberControl as NumberControl, TextControl} from '@wordpress/components';
import {SelectControl, PanelBody} from "@wordpress/components";
import Select from 'react-select';
import {FORMATE_USERS, USER_ORDER_BY, POST_SORT_ORDER} from "../../components/Constants";
import {MultiSelectSort} from "../../components/Components";

const {Spinner} = wp.components;

export default function ContentQuery(props) {
    const {attributes, setAttributes, changeQuery, userData} = props.data;

    //All attribute
    const {
        users_lists,
        user_limit,
        users_role,
        user_filter_by_domain,
        orderby,
        order,
    } = attributes;

    return (

        <PanelBody title={__('Query', 'user-grid')} initialOpen={false}>

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

            <div className="components-base-control dowp-repeater">
                <label
                    className="components-base-control__label components-input-control__label"
                    htmlFor="react-select-2-input">
                    {__('Choose Users', 'user-grid')}
                    {!userData.users && <Spinner/>}
                </label>


                <MultiSelectSort
                    options={FORMATE_USERS(userData.users, 'email')}
                    value={users_lists}
                    onChange={(value) => {
                        setAttributes({users_lists: value})
                        changeQuery()
                    }}
                    closeMenuOnSelect={false}
                    isClearable={false}
                    isSingleLine={true}
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


            {!users_lists.length &&
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
            }

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

        </PanelBody>

    );
}