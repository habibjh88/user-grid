import {__} from "@wordpress/i18n";
import {PanelBody, ToggleControl} from "@wordpress/components";
import {Sortable} from "../../components/Components";

export default function ContentSort(props) {
    const {attributes, setAttributes, changeQuery} = props.data;

    //All attribute
    const {
        content_order,
        content_order_default,
        enable_order
    } = attributes;

    const shortVisibility = enable_order === 'show' ? 'enable-sorting' : 'disable-shorting'

    return (

        <PanelBody title={__('Sort Content', 'user-grid')} initialOpen={false}>
            <ToggleControl
                label={__("Enable Content Order", "user-grid")}
                className="usgr-toggle-control-field"
                checked={enable_order}
                onChange={(enable_order) => {
                    setAttributes({enable_order: enable_order ? 'show' : ''});
                    setAttributes({content_order: content_order_default});
                    changeQuery();
                }}
            />
            <div className={`${shortVisibility}`}>
                <Sortable
                    value={content_order}
                    onChange={val => {
                        setAttributes({content_order: val});
                        changeQuery();
                    }}
                    label={"Sort Content"}
                />
            </div>
        </PanelBody>

    );
}