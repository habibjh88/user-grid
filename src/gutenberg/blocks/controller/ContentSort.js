import {__} from "@wordpress/i18n";
import { PanelBody} from "@wordpress/components";
import Sortable from "../../components/Sortable";
export default function ContentSort(props) {
    const {attributes, setAttributes, changeQuery, userData} = props.data;

    //All attribute
    const {
        content_order
    } = attributes;

    return (

        <PanelBody title={__('Sort Content', 'user-grid')} initialOpen={false}>
            <Sortable
                value={content_order}
                onChange={val => {
                    setAttributes({content_order: val});
                    changeQuery();
                }}
                label={"Sort Content"}
            />
        </PanelBody>

    );
}