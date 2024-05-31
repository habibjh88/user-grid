import {__} from "@wordpress/i18n";
import {PanelBody} from "@wordpress/components";
import {Color} from "../../components/Components";

export default function ContentGlobal(props) {
    const {attributes, setAttributes, changeQuery} = props.data;

    //All attribute
    const {
        primary_color,
        primary_dark,
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
        </PanelBody>
    );
}