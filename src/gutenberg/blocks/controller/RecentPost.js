import {__} from "@wordpress/i18n";
import {
    __experimentalNumberControl as NumberControl,
    PanelBody,
    SelectControl,
    TextControl, ToggleControl
} from '@wordpress/components';
import {Dimension, Color, Typography} from "../../components/Components";
import {POST_BOX_STYLE} from "../../components/Constants";

export default function RecentPost(props) {
    const {attributes, setAttributes, changeQuery} = props.data;
    //All attribute
    const {
        post_box_style,
        post_number,
        post_type_list,
        post_type,
        post_img_width,
        main_title_text,
        post_main_title_typo,
        post_main_title_color,
        post_title_typo,
        post_title_color,
        post_title_color_h,
        post_meta_typo,
        post_meta_color,
        post_meta_color_h,
        post_title_spacing,
        post_box_bg,
        show_post_img,
        show_post_cat,
        show_post_date,
        show_post_b_b,
        post_bottom_b_color,
        post_box_b_color,
    } = attributes;

    return (
        <PanelBody title={__('Recent Post', 'user-grid')} initialOpen={false}>

            <SelectControl
                label={__("Post Box Style", "user-grid")}
                className="usgr-control-field label-inline usgr-expand"
                value={post_box_style}
                options={POST_BOX_STYLE}
                onChange={(post_box_style) => {
                    setAttributes({post_box_style})
                    changeQuery()
                }}
            />

            <SelectControl
                label={__("Choose Post Type", "user-grid")}
                className="usgr-control-field label-inline usgr-expand"
                value={post_type}
                options={post_type_list}
                onChange={(post_type) => {
                    setAttributes({post_type})
                    changeQuery()
                }}
            />

            <NumberControl
                isShiftStepEnabled
                label={__("Post Number", "user-grid")}
                min={1}
                max={20}
                value={post_number}
                onChange={(post_number) => {
                    setAttributes({post_number})
                    changeQuery()
                }}
                placeholder={__("Eg. 2", "user-grid")}
                shiftStep={1}
                step="1"
                className="usgr-control-field label-inline"
            />

            <hr/>

            <ToggleControl
                label={__("Show Image?", "user-grid")}
                className="usgr-toggle-control-field"
                checked={show_post_img}
                onChange={(show_post_img) => {
                    setAttributes({show_post_img: show_post_img ? 'show' : ''});
                    changeQuery()
                }}
            />

            <ToggleControl
                label={__("Show Category?", "user-grid")}
                className="usgr-toggle-control-field"
                checked={show_post_cat}
                onChange={(show_post_cat) => {
                    setAttributes({show_post_cat: show_post_cat ? 'show' : ''});
                    changeQuery()
                }}
            />

            <ToggleControl
                label={__("Show Date?", "user-grid")}
                className="usgr-toggle-control-field"
                checked={show_post_date}
                onChange={(show_post_date) => {
                    setAttributes({show_post_date: show_post_date ? 'show' : ''});
                    changeQuery()
                }}
            />

            <ToggleControl
                label={__("Show Border Bottom?", "user-grid")}
                className="usgr-toggle-control-field"
                checked={show_post_b_b}
                onChange={(show_post_b_b) => {
                    setAttributes({show_post_b_b: show_post_b_b ? 'show' : ''});
                    changeQuery()
                }}
            />

            <h3 className={`usgr-controll-heading`}>{__("Image Settings", "user-grid")}</h3>
            <NumberControl
                isShiftStepEnabled
                label={__("Post Number", "user-grid")}
                min={30}
                max={150}
                value={post_img_width}
                onChange={(post_img_width) => {
                    setAttributes({post_img_width})
                    changeQuery()
                }}
                placeholder={__("Eg. 40", "user-grid")}
                shiftStep={1}
                step="1"
                className="usgr-control-field label-inline"
            />

            <h3 className={`usgr-controll-heading`}>{__("Main Title Settings", "user-grid")}</h3>

            <TextControl
                autocomplete="off"
                help="Keep empty for hide the button."
                label={__("Button Text", "user-grid")}
                value={main_title_text}
                placeholder="Eg. Recent Post"
                onChange={(main_title_text) => {
                    setAttributes({main_title_text})
                    changeQuery();
                }}
            />

            <Typography
                label={__('Main Title Typography')}
                value={post_main_title_typo}
                onChange={(val) => setAttributes({post_main_title_typo: val})}
            />

            <Color
                label={__('Main Title Color', 'user-grid')}
                color={post_main_title_color}
                onChange={(post_main_title_color) => setAttributes({post_main_title_color})}
            />

            <h3 className={`usgr-controll-heading`}>{__("Post Title", "user-grid")}</h3>

            <Typography
                label={__('Title Typography')}
                value={post_title_typo}
                onChange={(val) => setAttributes({post_title_typo: val})}
            />

            <Color
                label={__('Title Color', 'user-grid')}
                color={post_title_color}
                onChange={(post_title_color) => setAttributes({post_title_color})}
            />
            <Color
                label={__('Title Color : hover', 'user-grid')}
                color={post_title_color_h}
                onChange={(post_title_color_h) => setAttributes({post_title_color_h})}
            />
            <Dimension
                label={__("Title Space", "user-grid")}
                type="margin" responsive
                value={post_title_spacing}
                onChange={(value) => {
                    setAttributes({post_title_spacing: value})
                }}
            />

            <h3 className={`usgr-controll-heading`}>{__("Post Meta", "user-grid")}</h3>

            <Typography
                label={__('Title Typography')}
                value={post_meta_typo}
                onChange={(val) => setAttributes({post_meta_typo: val})}
            />

            <Color
                label={__('Title Color', 'user-grid')}
                color={post_meta_color}
                onChange={(post_meta_color) => setAttributes({post_meta_color})}
            />
            <Color
                label={__('Title Color : hover', 'user-grid')}
                color={post_meta_color_h}
                onChange={(post_meta_color_h) => setAttributes({post_meta_color_h})}
            />

            <h3 className={`usgr-controll-heading`}>{__("Post Box", "user-grid")}</h3>

            <Color
                label={__('Box Background', 'user-grid')}
                color={post_box_bg}
                onChange={(post_box_bg) => setAttributes({post_box_bg})}
            />

            {show_post_b_b &&
                <Color
                    label={__('Bottom Border Color', 'user-grid')}
                    color={post_bottom_b_color}
                    onChange={(post_bottom_b_color) => setAttributes({post_bottom_b_color})}
                />
            }
            {post_box_style.includes('pbox-b') &&
                <Color
                    label={__('Box Border Color', 'user-grid')}
                    color={post_box_b_color}
                    onChange={(post_box_b_color) => setAttributes({post_box_b_color})}
                />
            }
        </PanelBody>
    );
}
