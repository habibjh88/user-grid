import RangeDevice from "../../components/RangeDevice";

const {__} = wp.i18n;
import {
    __experimentalNumberControl as NumberControl,
    SelectControl,
    TextControl,
    ToggleControl,
    PanelBody,
} from "@wordpress/components";
import {BUTTON_POSITION, BUTTON_SPACE_BETWEEN, PAGINATION_TYPE, RTTPG_IS_PRO} from "../../components/Constants";

function PaginationController(props) {
    const {attributes, setAttributes, changeQuery} = props.data;
    //All attribute
    const {
        show_pagination,
        display_per_page,
        pagination_type,
        ajax_pagination_type,
        load_more_button_text,
        pagination_btn_position,
        pagination_pos_val,
        pagination_pos_val_left,
        pagination_btn_space_btween
    } = attributes;

    return (
        <PanelBody title={__('Pagination', 'the-post-grid')} initialOpen={false}>
            <ToggleControl
                label={__("Show Pagination", "the-post-grid")}
                className="rttpg-toggle-control-field"
                checked={show_pagination}
                onChange={(show_pagination) => {
                    setAttributes({show_pagination: show_pagination ? 'show' : ''})
                    changeQuery()
                }}
            />
            {show_pagination === 'show' && (
                <>
                    <NumberControl
                        isShiftStepEnabled
                        label={__("Display Per Page", "the-post-grid")}
                        help={__("Enter how may posts will display per page", "the-post-grid")}
                        max={100}
                        min={0}
                        value={display_per_page}
                        onChange={(value) => {
                            setAttributes({display_per_page: value})
                            changeQuery()
                        }}
                        shiftStep={10}
                        step="1"
                        className="rttpg-control-field label-inline"
                    />

                    <SelectControl
                        label={__("Pagination Type", "the-post-grid")}
                        className="rttpg-control-field label-inline rttpg-expand"
                        options={PAGINATION_TYPE}
                        value={pagination_type}
                        onChange={(pagination_type) => setAttributes({pagination_type})}
                    />

                    {pagination_type === 'pagination_ajax' && (
                        <>
                            <ToggleControl
                                label={__("Enable Ajax Next Previous", "the-post-grid")}
                                className="rttpg-toggle-control-field"
                                checked={ajax_pagination_type}
                                onChange={(ajax_pagination_type) => setAttributes({ajax_pagination_type: ajax_pagination_type ? 'yes' : ''})}
                            />
                            {ajax_pagination_type === 'yes' &&
                                <>
                                    <SelectControl
                                        label={__("Button Position", "the-post-grid")}
                                        className="rttpg-control-field label-inline rttpg-expand"
                                        options={BUTTON_POSITION}
                                        value={pagination_btn_position}
                                        onChange={(pagination_btn_position) => setAttributes({pagination_btn_position})}
                                    />

                                    {pagination_btn_position === 'absolute' &&
                                        <>
                                            <RangeDevice
                                                label={__('Value From Top', 'the-post-grid')}
                                                help={__("You can input a negative number if you need.", "the-post-grid")}
                                                responsive={true}
                                                value={pagination_pos_val}
                                                min={-300}
                                                max={500}
                                                step={1}
                                                onChange={(val) => {
                                                    setAttributes({pagination_pos_val: val})
                                                }}
                                            />
                                            <RangeDevice
                                                label={__('Value From Left', 'the-post-grid')}
                                                help={__("You can input a negative number if you need.", "the-post-grid")}
                                                responsive={true}
                                                value={pagination_pos_val_left}
                                                min={-300}
                                                max={500}
                                                step={1}
                                                onChange={(val) => {
                                                    setAttributes({pagination_pos_val_left: val})
                                                }}
                                            />

                                            <SelectControl
                                                label={__("Enable Space Between", "the-post-grid")}
                                                className="rttpg-control-field label-inline rttpg-expand"
                                                options={BUTTON_SPACE_BETWEEN}
                                                value={pagination_btn_space_btween}
                                                onChange={(pagination_btn_space_btween) => setAttributes({pagination_btn_space_btween})}
                                            />
                                        </>

                                    }
                                </>}
                        </>
                    )}

                    {pagination_type === 'load_more' && (<TextControl
                        autocomplete="off"
                        label={__("Button Text", "the-post-grid")}
                        className="rttpg-control-field label-inline rttpg-expand"
                        placeholder="Enter Button Text Here.."
                        value={load_more_button_text}
                        onChange={(load_more_button_text) => setAttributes({load_more_button_text})}
                    />)}

                    {RTTPG_IS_PRO === 'rttpg-is-pro' &&
                        <p className="rttpg-help">{__("NB. Please upgrade to pro for loadmore and ajax pagination", "the-post-grid")}</p>}

                </>)}
        </PanelBody>
    );
}

export default PaginationController;
