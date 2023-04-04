import Background from "../../components/Background";

const {__} = wp.i18n;
import {PanelBody, SelectControl} from "@wordpress/components";
import Dimension from "../../components/Dimension";
import RangeDevice from "../../components/RangeDevice";

function WrapperStyle(props) {
    const {attributes, setAttributes} = props.data;

    //All attribute
    const {tpg_wrapper_padding, tpg_wrapper_margin, tpg_wrapper_width, tpg_wrapper_background, tpg_wrapper_radius} = attributes;

    return (
        <PanelBody title={__('Main Wrapper', 'the-post-grid')} initialOpen={false}>

            <Dimension
                label={__("Main Wrapper Padding", "the-post-grid")}
                type="padding" responsive
                value={tpg_wrapper_padding}
                onChange={(value) => {
                    setAttributes({tpg_wrapper_padding: value})
                }}
            />

            <Dimension
                label={__("Main Wrapper Border Radius", "the-post-grid")}
                type="borderRadius" responsive
                value={tpg_wrapper_radius}
                onChange={(value) => {
                    setAttributes({tpg_wrapper_radius: value})
                }}
            />

            <Dimension
                label={__("Main Wrapper Margin", "the-post-grid")}
                type="margin" responsive
                value={tpg_wrapper_margin}
                disableLink={true}
                onChange={(value) => {
                    setAttributes({tpg_wrapper_margin: value})
                }}
            />

            <small
                className="rttpg-help">{__("NB. If you use The Post Grid Fullwidth template then margin-left and margin-right will not work.", "the-post-grid")}</small>

            <RangeDevice
                label={__('Wrapper Width')}
                responsive={true}
                value={tpg_wrapper_width}
                min={300}
                max={3000}
                step={1}
                onChange={(val) => setAttributes({tpg_wrapper_width: val})}
                help={`Default width is 1200px for large device. If you want you can increase or decrease the size.`}
            />

            <Background
                // image={false}
                label={__("Wrapper Background", "the-post-grid")}
                value={tpg_wrapper_background}
                onChange={val => setAttributes({tpg_wrapper_background: val})}
            />


        </PanelBody>
    );
}

export default WrapperStyle;
