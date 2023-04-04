const {__} = wp.i18n;
import {SelectControl, PanelBody} from "@wordpress/components";
import {POST_LINK_TYPE, RTTPG_IS_PRO} from "../../components/Constants";

function LinksController(props) {
    const {attributes, setAttributes} = props.data;
    //All attribute
    const {post_link_type, link_target, is_thumb_linked} = attributes;

    return (
        <PanelBody title={__('Links', 'the-post-grid')} initialOpen={false}>
            <SelectControl
                label={__("Post link type", "the-post-grid")}
                className="rttpg-control-field label-inline rttpg-expand"
                options={POST_LINK_TYPE}
                value={post_link_type}
                onChange={(post_link_type) => setAttributes({post_link_type})}
            />

            {RTTPG_IS_PRO === 'rttpg-is-pro' &&
                <p className="rttpg-help">{__("NB. Please upgrade to pro for popup options", "the-post-grid")}</p>}

            {post_link_type === 'default' && (
                <SelectControl
                    label={__("Link Target", "the-post-grid")}
                    className="rttpg-control-field label-inline rttpg-expand"
                    options={[
                        {value: '_self', label: __('Same Window', 'the-post-grid')},
                        {value: '_blank', label: __('New Window', 'the-post-grid')}
                    ]}
                    value={link_target}
                    onChange={(link_target) => setAttributes({link_target})}
                />)}

            <SelectControl
                label={__("Thumbnail Link", "the-post-grid")}
                className="rttpg-control-field label-inline rttpg-expand"
                options={[{value: 'yes', label: __('Yes', 'the-post-grid')}, {
                    value: 'no',
                    label: __('No', 'the-post-grid')
                }]}
                value={is_thumb_linked}
                onChange={(is_thumb_linked) => setAttributes({is_thumb_linked})}
            />
        </PanelBody>
    );
}

export default LinksController;
