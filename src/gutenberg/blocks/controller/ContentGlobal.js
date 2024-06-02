import {__} from "@wordpress/i18n";
import {PanelBody, TextareaControl} from "@wordpress/components";
import {Color} from "../../components/Components";

export default function ContentGlobal(props) {
    const {attributes, setAttributes, changeQuery} = props.data;

    //All attribute
    const {
        primary_color,
        primary_dark,
        multiple_bg
    } = attributes;


    return (
        <PanelBody title={__('Global Settings', 'user-grid')} initialOpen={false}>
            <Color
                label={__('Block Primary Color', 'user-grid')}
                color={primary_color}
                onChange={(primary_color) => {
                    setAttributes({primary_color})
                    changeQuery();
                }}
            />
            <Color
                label={__('Block Primary Color', 'user-grid')}
                color={primary_dark}
                onChange={(primary_dark) => {
                    setAttributes({primary_dark})
                    changeQuery();
                }}
            />

            <TextareaControl
                label="Different Card Background"
                value={ multiple_bg }
                rows={2}
                placeholder={`#E8EFCD, #DCF5F2, lightcoral, lightpink`}
                onChange={val => {
                    setAttributes({multiple_bg: val})
                    changeQuery()
                }}
                help="Enter colors code or name separate by comma (,) for each card item. Eg. #E6F0F2, #E9E7E7, #F3EDDE, #E8EFCD, #DCF5F2"
            />
        </PanelBody>
    );
}