const {__} = wp.i18n;
import {__experimentalHeading as Heading} from '@wordpress/components';
import Select from 'react-select';
import "flatpickr/dist/themes/light.css";
import Flatpickr from "react-flatpickr";
import cogoToast from 'cogo-toast';
import {
    SelectControl,
    ToggleControl,
    TextControl,
    PanelBody,
    __experimentalNumberControl as NumberControl
} from "@wordpress/components";

import {
    POSTS_TYPE,
    AUTHOR_LISTS,
    TAX_RELATION,
    PRINT_TAXONOMY,
    POST_ORDER_BY,
    POST_SORT_ORDER,
    RTTPG_IS_PRO
} from "../../components/Constants";

function QueryController(props) {
    const {attributes, setAttributes, changeQuery} = props.data;

    //All attribute
    const {
        ignore_sticky_posts,
        no_posts_found_text,
        post_type,
        post_id,
        exclude,
        post_limit,
        offset,
        author,
        post_keyword,
        relation,
        orderby,
        order,
        taxonomy_lists,
        start_date,
        end_date
    } = attributes;

    const allTermList = rttpgParams.all_term_list;
    const allTaxonomyList = rttpgParams.get_taxonomies;

    let tpgAllTaxonomies = new Set();
    for (let tax in allTaxonomyList) {
        let value = allTaxonomyList[tax];
        if (value.object_type[0] === post_type) {
            tpgAllTaxonomies.add({
                value: value.name, name: value.label
            });
        }
    }
    tpgAllTaxonomies = [...tpgAllTaxonomies];

    return (
        <PanelBody title={__('Query Build', 'the-post-grid')} initialOpen={false}>
            <SelectControl
                label={__('Post Source', 'the-post-grid')}
                className="rttpg-control-field label-inline rttpg-expand"
                value={post_type}
                options={POSTS_TYPE}
                onChange={(post_type) => {
                    setAttributes({post_type, page: 1})
                    changeQuery()
                }}
            />

            <Heading className="rttpg-control-heading">
                {__("Common Filters:", "the-post-grid")}
            </Heading>

            <TextControl
                autocomplete="off"
                label={__("Include only", "the-post-grid")}
                help={__("Enter the post IDs separated by comma for include", "the-post-grid")}
                className="rttpg-control-field label-inline rttpg-expand has-help"
                placeholder="Eg. 10, 15, 17"
                value={post_id}
                onChange={(post_id) => {
                    setAttributes({post_id})
                    changeQuery()
                }}
            />

            <TextControl
                autocomplete="off"
                label={__("Exclude", "the-post-grid")}
                help={__("Enter the post IDs separated by comma for exclude", "the-post-grid")}
                placeholder="Eg. 12, 13"
                className="rttpg-control-field label-inline rttpg-expand has-help"
                value={exclude}
                onChange={(exclude) => {
                    setAttributes({exclude})
                    changeQuery()
                }}
            />

            <NumberControl
                isShiftStepEnabled
                label={__("Limit", "the-post-grid")}
                help={__("The number of posts to show. Enter -1 to show all found posts.", "the-post-grid")}
                max={100}
                min={-1}
                value={post_limit}
                onChange={(post_limit) => {
                    setAttributes({post_limit})
                    changeQuery()
                }}
                placeholder={__("Eg. 36", "the-post-grid")}
                shiftStep={10}
                step="1"
                className="rttpg-control-field label-inline"
            />

            <NumberControl
                isShiftStepEnabled
                label={__("Offset", "the-post-grid")}
                max={100}
                min={0}
                value={offset}
                onChange={(offset) => {
                    setAttributes({offset})
                    changeQuery()
                }}
                placeholder={__("Eg. 3", "the-post-grid")}
                shiftStep={10}
                step="1"
                className="rttpg-control-field label-inline"
            />

            <Heading className="rttpg-control-heading">
                {__("Advanced Filters:", "the-post-grid")}
            </Heading>

            <div className="rttpg-ground-control">
                {tpgAllTaxonomies.map((taxonomy) => {
                    return (
                        <div className="components-base-control rttpg-repeater">
                            <label
                                className="components-base-control__label components-input-control__label"
                                htmlFor="react-select-2-input">
                                {__('By ' + taxonomy.name, 'the-post-grid')}
                            </label>

                            <Select
                                options={PRINT_TAXONOMY(allTermList[taxonomy.value])}
                                value={Object.keys(taxonomy_lists).length > 0 ? taxonomy_lists[taxonomy.value] !== undefined ? taxonomy_lists[taxonomy.value].options : [] : []}
                                onChange={(value) => {
                                    props.changeTaxonomy(value, taxonomy.value)
                                }}
                                isMulti={true}
                                closeMenuOnSelect={true}
                                isClearable={false}
                            />
                        </div>
                    )
                })}

                <SelectControl
                    label={__("Taxonomies Relation", "the-post-grid")}
                    className="rttpg-control-field label-inline"
                    value={relation}
                    options={TAX_RELATION}
                    onChange={(relation) => {
                        setAttributes({relation})
                        changeQuery()
                    }}
                />
            </div>


            <SelectControl
                label={__("By Author", "the-post-grid")}
                className="rttpg-control-field label-inline rttpg-expand"
                value={author}
                options={AUTHOR_LISTS}
                onChange={(author) => {
                    setAttributes({author})
                    changeQuery()
                }}
            />


            <TextControl
                autocomplete="off"
                label={__("By Keyword", "the-post-grid")}
                className="rttpg-control-field label-inline rttpg-expand"
                placeholder="Search by keyword"
                value={post_keyword}
                onChange={(post_keyword) => {
                    setAttributes({post_keyword})
                    changeQuery()
                }}
            />

            <div className={`rttpg-elm-wrapper ${RTTPG_IS_PRO}`}>
                <label>{__("Start Date", "the-post-grid")}</label>
                <Flatpickr
                    label={__("Start Date", "the-post-grid")}
                    options={{'dateFormat': "M j, Y"}}
                    placeholder="Choose Start Date..."
                    value={start_date}
                    onChange={([start_date]) => {
                        setAttributes({start_date})
                        changeQuery()
                    }}
                />
                {RTTPG_IS_PRO === 'rttpg-is-pro' && <div className={`rttpg-alert-message`} onClick={() => {
                    cogoToast.warn('Please upgrade to pro for this feature.', {position: 'top-right'});
                }}></div>}
            </div>

            <div className={`rttpg-elm-wrapper ${RTTPG_IS_PRO}`}>
                <label> {__("End Date", "the-post-grid")}</label>
                <Flatpickr
                    label={__("End Date", "the-post-grid")}
                    options={{'dateFormat': "M j, Y"}}
                    placeholder="Choose End Date..."
                    value={end_date}
                    onChange={([end_date]) => {
                        setAttributes({end_date})
                        changeQuery()
                    }}
                />
                {RTTPG_IS_PRO === 'rttpg-is-pro' && <div className={`rttpg-alert-message`} onClick={() => {
                    cogoToast.warn('Please upgrade to pro for this feature.', {position: 'top-right'});
                }}></div>}
            </div>

            <SelectControl
                label={__("Order By", "the-post-grid")}
                className="rttpg-control-field label-inline rttpg-expand"
                value={orderby}
                options={POST_ORDER_BY}
                onChange={(orderby) => {
                    setAttributes({orderby})
                    changeQuery()
                }}
            />

            <SelectControl
                label={__("Sort Order", "the-post-grid")}
                className="rttpg-control-field label-inline rttpg-expand"
                value={order}
                options={POST_SORT_ORDER}
                onChange={(order) => {
                    setAttributes({order})
                    changeQuery()
                }}
            />
            <hr/>

            <div className={`rttpg-elm-wrapper ${RTTPG_IS_PRO}`}>
                <>
                    <ToggleControl
                        label={__("Ignore sticky posts", "the-post-grid")}
                        className="rttpg-toggle-control-field"
                        checked={ignore_sticky_posts}
                        onChange={(ignore_sticky_posts) => {
                            setAttributes({ignore_sticky_posts: ignore_sticky_posts ? 'yes' : ''})
                            changeQuery()
                        }}
                    />
                    {RTTPG_IS_PRO === 'rttpg-is-pro' && <div className={`rttpg-alert-message`} onClick={() => {
                        cogoToast.warn('Please upgrade to pro for this feature.', {position: 'top-right'});
                    }}></div>}
                </>
            </div>
            <hr/>

            {/*setAttributes({no_posts_found_text})*/}
            {/*changeQuery()*/}

            <TextControl
                autocomplete="off"
                label={__("No Post Found Text", "the-post-grid")}
                className="rttpg-control-field"
                value={no_posts_found_text}
                onChange={val => {
                    setAttributes({no_posts_found_text: val});
                    changeQuery()
                }
                }
            />
        </PanelBody>
    );
}

export default QueryController;
