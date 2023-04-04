const {__} = wp.i18n;
import {
    SelectControl,
    ToggleControl,
    PanelBody,
    __experimentalNumberControl as NumberControl
} from "@wordpress/components";
import Media from "../../components/Media";
import RangeDevice from "../../components/RangeDevice";
import cogoToast from "cogo-toast";
import {RTTPG_IS_PRO, TPG_HOVER_ANIMATION} from "../../components/Constants";

function PostThumbnailSettings(props) {
    const {attributes, setAttributes, changeQuery} = props.data;
    const imageSizes = [...props.imageSizes];
    //All attribute
    const {
        prefix,
        media_source,
        image_size,
        img_crop_style,
        c_image_width,
        c_image_height,
        image_height,
        offset_image_height,
        image_offset_size,
        hover_animation,
        is_thumb_lightbox,
        is_default_img,
        default_image,
        list_image_side_width,
        show_thumb
    } = attributes;

    if (show_thumb !== 'show') {
        return '';
    }

    let postLayout = prefix + "_layout";

    return (
        <PanelBody title={__('Thumbnail', 'the-post-grid')} initialOpen={false}>

            <SelectControl
                label={__("Media Source", "the-post-grid")}
                className="rttpg-control-field label-inline"
                options={[
                    {value: 'feature_image', label: __('Feature Image', 'the-post-grid')},
                    {value: 'first_image', label: __('First Image from content', 'the-post-grid')}
                ]}
                value={media_source}
                onChange={(media_source) => {
                    setAttributes({media_source})
                    changeQuery()
                }}
            />


            {media_source === 'feature_image' && <>
                <SelectControl
                    label={__("Image Size", "the-post-grid")}
                    className="rttpg-control-field label-inline"
                    options={imageSizes}
                    value={image_size}
                    onChange={(image_size) => {
                        setAttributes({image_size})
                        changeQuery()
                    }}
                />

                <div className={`rttpg-arert-wrapper ${RTTPG_IS_PRO}`}>
                    {RTTPG_IS_PRO === 'rttpg-is-pro' &&
                        <div className={`rttpg-alert-message`} onClick={() => {
                            cogoToast.warn('Please upgrade to pro for this feature.', {position: 'top-right'});
                        }}></div>}
                    <RangeDevice
                        label={__('Image Height')}
                        className={`rttpg-control-field label-inline ${RTTPG_IS_PRO}`}
                        responsive={true}
                        min={0}
                        max={1000}
                        step={1}
                        value={image_height}
                        onChange={(val) => setAttributes({image_height: val})}
                    />
                </div>

                {(media_source === 'feature_image' && [
                        'grid-layout5', 'grid-layout5-2', 'grid-layout6', 'grid-layout6-2', 'list-layout2', 'list-layout3', 'list-layout2-2', 'list-layout3-2',
                        'grid_hover-layout4', 'grid_hover-layout4-2', 'grid_hover-layout5', 'grid_hover-layout5-2', 'grid_hover-layout6', 'grid_hover-layout6-2',
                        'grid_hover-layout7', 'grid_hover-layout7-2', 'grid_hover-layout9', 'grid_hover-layout9-2', 'slider-layout10'
                    ].includes(attributes[postLayout])) &&
                    <>
                        <SelectControl
                            label={__("Offset (Small) Image Size", "the-post-grid")}
                            className="rttpg-control-field label-inline"
                            options={imageSizes}
                            value={image_offset_size}
                            onChange={(image_offset_size) => {
                                setAttributes({image_offset_size})
                                changeQuery()
                            }}
                            help="Change offset small image size"
                        />

                        <div className={`rttpg-arert-wrapper ${RTTPG_IS_PRO}`}>
                            {RTTPG_IS_PRO === 'rttpg-is-pro' &&
                                <div className={`rttpg-alert-message`} onClick={() => {
                                    cogoToast.warn('Please upgrade to pro for this feature.', {position: 'top-right'});
                                }}></div>}
                            <RangeDevice
                                label={__('Offset (Small) Image Height')}
                                className={`rttpg-control-field label-inline ${RTTPG_IS_PRO}`}
                                responsive={true}
                                min={0}
                                max={1000}
                                step={1}
                                value={offset_image_height}
                                onChange={(val) => setAttributes({offset_image_height: val})}
                            />
                        </div>
                    </>
                }

                {(image_size === 'custom' && media_source === 'feature_image') && (
                    <div className="rttpg-ground-control">
                        <SelectControl
                            label={__("Image Crop Style", "the-post-grid")}
                            className="rttpg-control-field label-inline rttpg-expand"
                            options={[
                                {value: 'soft', label: __('Soft Crop', 'the-post-grid')},
                                {value: 'hard', label: __('Hard Crop', 'the-post-grid')}
                            ]}
                            value={img_crop_style}
                            onChange={(img_crop_style) => setAttributes({img_crop_style})}
                        />

                        <div className="rttpg-image-dimension">

                            <label
                                className="components-base-control__label components-input-control__label"
                                htmlFor="react-select-2-input">
                                {__('Image Dimension', 'the-post-grid')}
                            </label>

                            <NumberControl
                                // label={ __( "Width", "the-post-grid" ) }
                                className="rttpg-control-field"
                                max={2000}
                                min={1}
                                placeholder="Width"
                                step="1"
                                value={c_image_width}
                                onChange={(c_image_width) => setAttributes({c_image_width})}
                            />

                            <NumberControl
                                // label={ __( "Height", "the-post-grid" ) }
                                className="rttpg-control-field"
                                max={2000}
                                min={1}
                                placeholder="Height"
                                step="1"
                                value={c_image_height}
                                onChange={(c_image_height) => setAttributes({c_image_height})}
                            />

                        </div>

                        <small
                            className="rttpg-help danger">{__("NB: Custom image size works only on front-end.", "the-post-grid")}</small>

                    </div>)}

            </>}

            {prefix === 'list' && ['list-layout1', 'list-layout5'].includes(attributes[postLayout]) &&
                <RangeDevice
                    label={__('List Image Width')}
                    responsive={true}
                    min={0}
                    max={700}
                    step={1}
                    value={list_image_side_width}
                    onChange={(val) => setAttributes({list_image_side_width: val})}
                />
            }

            <SelectControl
                label={__("Image Hover Animation", "the-post-grid")}
                className="rttpg-control-field label-inline rttpg-expand"
                options={TPG_HOVER_ANIMATION}
                value={hover_animation}
                onChange={(hover_animation) => setAttributes({hover_animation})}
            />

            {RTTPG_IS_PRO === 'rttpg-is-pro' &&
                <p className="rttpg-help">{__("Please upgrade to pro for more animation", "the-post-grid")}</p>}


            <div className="rttpg-arert-wrapper">

                {RTTPG_IS_PRO === 'rttpg-is-pro' &&
                    <div className={`rttpg-alert-message`} onClick={() => {
                        cogoToast.warn('Please upgrade to pro for this feature.', {position: 'top-right'});
                    }}></div>}

                <SelectControl
                    label={__("Light Box", "the-post-grid")}
                    className={`rttpg-control-field label-inline ${RTTPG_IS_PRO}`}
                    options={[
                        {value: 'default', label: __('Default', 'the-post-grid')}, {
                            value: 'show', label: __('Show', 'the-post-grid')
                        }, {value: 'hide', label: __('Hide', 'the-post-grid')}
                    ]}
                    value={is_thumb_lightbox}
                    onChange={(is_thumb_lightbox) => setAttributes({is_thumb_lightbox})}
                />

                <ToggleControl
                    label={__("Enable Default Image", "the-post-grid")}
                    className={`rttpg-toggle-control-field ${RTTPG_IS_PRO}`}
                    checked={is_default_img}
                    onChange={(is_default_img) => setAttributes({is_default_img: is_default_img ? 'yes' : ''})}
                />


                {is_default_img === 'yes' && RTTPG_IS_PRO !== 'rttpg-is-pro' &&
                    <Media
                        label={__("Default Image", "the-post-grid")}
                        className={RTTPG_IS_PRO}
                        multiple={false}
                        type={['image']}
                        panel={true}
                        value={default_image}
                        onChange={val => {
                            setAttributes({default_image: val})
                            changeQuery()
                        }}
                    />
                }
            </div>


        </PanelBody>
    );
}

export default PostThumbnailSettings;
