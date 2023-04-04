const {__} = wp.i18n;
import {
    __experimentalHeading as Heading,
    PanelBody,
    SelectControl,
    TextControl,
    ToggleControl
} from '@wordpress/components';
import Select from 'react-select';
import cogoToast from "cogo-toast";
import {META_ORDERING_LABEL, META_POSITION, RTTPG_IS_PRO} from "../../components/Constants";

function MetaSettings(props) {
    const {attributes, setAttributes, changeQuery} = props.data;

    //All attribute
    const {
        prefix,
        show_meta,
        show_category,
        category_position,
        category_style,
        show_cat_icon,
        category_source,
        tag_source,
        show_date,
        show_author,
        show_tags,
        show_comment_count,
        show_post_count,
        meta_position,
        meta_separator,
        author_prefix,
        show_meta_icon,
        author_icon_visibility,
        show_author_image,
        meta_ordering
    } = attributes;


    if (!(show_meta === 'show' && (show_date === 'show' || show_category === 'show' || show_author === 'show' || show_tags === 'show' || show_comment_count === 'show' || show_post_count === 'show'))) {
        return <></>;
    }

    let postLayout = prefix + "_layout";


    const allTaxonomyList = rttpgParams.get_taxonomies;

    let tpgAllTaxonomiesSelect = [];
    for (let tax in allTaxonomyList) {
        let value = allTaxonomyList[tax];
        tpgAllTaxonomiesSelect.push({
            value: value.name, label: value.label
        });
    }


    let catPositioin = [
        {value: 'style1', label: __('Style 1 - Only Text', 'the-post-grid')},
        {value: 'style4', label: __('Style 4 - Different Color', 'the-post-grid')}
    ];

    if ((category_position !== 'default' || ['grid-layout5', 'grid-layout5-2', 'grid-layout6', 'grid-layout6-2'].includes(attributes[postLayout]))) {
        catPositioin = [
            {value: 'style1', label: __('Style 1 - Only Text', 'the-post-grid')},
            {value: 'style2', label: __('Style 2 - Background', 'the-post-grid')},
            {value: 'style3', label: __('Style 3 - Fold edge', 'the-post-grid')},
            {value: 'style4', label: __('Style 4 - Different Color', 'the-post-grid')}
        ];
    }

    return (

        <PanelBody title={__('Meta Data', 'the-post-grid')} initialOpen={false}>

            <SelectControl
                label={__("Meta Position", "the-post-grid")}
                className="rttpg-control-field label-inline"
                options={META_POSITION}
                value={meta_position}
                onChange={(meta_position) => setAttributes({meta_position})}
            />
            {RTTPG_IS_PRO === 'rttpg-is-pro' &&
                <p className="rttpg-help">{__("Please upgrade to pro for meta position", "the-post-grid")}</p>}

            <ToggleControl
                label={__("Show Meta Icon", "the-post-grid")}
                className="rttpg-toggle-control-field"
                checked={show_meta_icon}
                onChange={(show_meta_icon) => setAttributes({show_meta_icon: show_meta_icon ? 'yes' : ''})}
            />

            <SelectControl
                label={__("Meta Separator", "the-post-grid")}
                className="rttpg-control-field label-inline"
                options={[
                    {value: 'default', label: __('Default - None', 'the-post-grid')},
                    {value: '.', label: __('Dot ( . )', 'the-post-grid')},
                    {value: '/', label: __('Single Slash ( / )', 'the-post-grid')},
                    {value: '//', label: __('Double Slash ( // )', 'the-post-grid')},
                    {value: '-', label: __('Hyphen ( - )', 'the-post-grid')},
                    {value: '|', label: __('Vertical Pipe ( | )', 'the-post-grid')}
                ]}
                value={meta_separator}
                onChange={(meta_separator) => setAttributes({meta_separator})}
            />

            <hr/>

            {show_author === 'show' && (
                <>
                    <Heading className="rttpg-control-heading">
                        {__("Author Setting:", "the-post-grid")}
                    </Heading>

                    <TextControl
                        autocomplete="off"
                        label={__("Author Prefix", "the-post-grid")}
                        placeholder="By"
                        className="rttpg-control-field label-inline"
                        value={author_prefix}
                        onChange={(author_prefix) => setAttributes({author_prefix})}
                    />

                    <SelectControl
                        label={__("Author Icon Visibility", "the-post-grid")}
                        className="rttpg-control-field label-inline"
                        options={[
                            {value: 'default', label: __('Default', 'the-post-grid')},
                            {value: 'hide', label: __('Hide', 'the-post-grid')},
                            {value: 'show', label: __('Show', 'the-post-grid')}
                        ]}
                        value={author_icon_visibility}
                        onChange={(author_icon_visibility) => setAttributes({author_icon_visibility})}
                    />

                    {author_icon_visibility !== 'hide' && (
                        <SelectControl
                            label={__("Author Image / Icon", "the-post-grid")}
                            className="rttpg-control-field label-inline"
                            options={[
                                {value: 'image', label: __('Image', 'the-post-grid')},
                                {value: 'icon', label: __('Icon', 'the-post-grid')}
                            ]}
                            value={show_author_image}
                            onChange={(show_author_image) => setAttributes({show_author_image})}
                        />
                    )}

                </>
            )}

            {(show_meta === 'show' && show_category === 'show') &&
                <>
                    <Heading className="rttpg-control-heading">
                        {__("Category and Tags Setting:", "the-post-grid")}
                    </Heading>

                    <div className="rttpg-arert-wrapper">
                        <SelectControl
                            label={__("Category Position", "the-post-grid")}
                            className={`rttpg-control-field label-inline  ${RTTPG_IS_PRO}`}
                            options={[{value: 'default', label: __('Default', 'the-post-grid')}, {
                                value: 'above_title',
                                label: __('Above Title', 'the-post-grid')
                            }, {value: 'with_meta', label: __('With Meta', 'the-post-grid')}, {
                                value: 'top_left',
                                label: __('Over image (Top Left)', 'the-post-grid')
                            }, {value: 'top_right', label: __('Over image (Top Right)', 'the-post-grid')}, {
                                value: 'bottom_left',
                                label: __('Over image (Bottom Left)', 'the-post-grid')
                            }, {
                                value: 'bottom_right',
                                label: __('Over image (Bottom Right)', 'the-post-grid')
                            }, {value: 'image_center', label: __('Over image (Center)', 'the-post-grid')}]}
                            value={category_position}
                            onChange={(category_position) => {
                                setAttributes({category_position})
                                changeQuery()
                            }}
                        />
                        {RTTPG_IS_PRO === 'rttpg-is-pro' &&
                            <div className={`rttpg-alert-message`} onClick={() => {
                                cogoToast.warn('Please upgrade to pro for this feature.', {position: 'top-right'});
                            }}></div>}
                    </div>


                    <SelectControl
                        label={__("Category Style", "the-post-grid")}
                        className="rttpg-control-field label-inline "
                        options={catPositioin}
                        value={category_style}
                        onChange={(category_style) => setAttributes({category_style})}
                    />

                    {category_position !== 'with_meta' && <ToggleControl
                        label={__("Show Over Image Category Icon", "the-post-grid")}
                        className="rttpg-toggle-control-field"
                        checked={show_cat_icon}
                        onChange={(show_cat_icon) => setAttributes({show_cat_icon: show_cat_icon ? 'yes' : ''})}
                    />}


                    <SelectControl
                        label={__("Category Source", "the-post-grid")}
                        className="rttpg-control-field label-inline "
                        options={tpgAllTaxonomiesSelect}
                        value={category_source}
                        onChange={(category_source) => {
                            setAttributes({category_source})
                            changeQuery()
                        }}
                    />

                    <SelectControl
                        label={__("Tag Source", "the-post-grid")}
                        className="rttpg-control-field label-inline "
                        options={tpgAllTaxonomiesSelect}
                        value={tag_source}
                        onChange={(tag_source) => {
                            setAttributes({tag_source})
                            changeQuery()
                        }}
                    />
                </>
            }

            <div className="components-base-control rttpg-repeater">
                <label
                    className="components-base-control__label components-input-control__label"
                    htmlFor="react-select-2-input">
                    {__('Meta Ordering', 'the-post-grid')}
                </label>

                <Select
                    options={META_ORDERING_LABEL}
                    value={meta_ordering}
                    onChange={(value) => {
                        setAttributes({meta_ordering: value})
                        changeQuery()
                    }}
                    help={__("Select sequentially from here for sort meta order.", 'the-post-grid')}
                    isMulti={true}
                    closeMenuOnSelect={false}
                    isClearable={false}
                />
            </div>

        </PanelBody>
    );
}

export default MetaSettings;
