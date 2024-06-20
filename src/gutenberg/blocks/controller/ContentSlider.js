import {__} from "@wordpress/i18n";
import {__experimentalNumberControl as NumberControl, TextControl, ToggleControl} from '@wordpress/components';
import {SelectControl, PanelBody} from "@wordpress/components";
import { POST_SORT_ORDER} from "../../components/Constants";

export default function ContentSlider(props) {
    const {attributes, setAttributes, changeQuery, userData} = props.data;

    //All attribute
    const {
        dots,
        arrow,
        fade,
        autoplay,
        adaptiveHeight,
        infinite,
        speed,
        autoplaySpeed,
    } = attributes;

    return (

        <PanelBody title={__('Slider Settings', 'user-grid')} initialOpen={false}>

            <ToggleControl
                label={__("Dots", "user-grid")}
                className="dowp-toggle-control-field"
                checked={dots}
                onChange={(dots) => {
                    setAttributes({dots: dots ? 'show' : ''});
                    changeQuery()
                }}
            />

            <ToggleControl
                label={__("Arrow", "user-grid")}
                className="dowp-toggle-control-field"
                checked={arrow}
                onChange={(arrow) => {
                    setAttributes({arrow: arrow ? 'show' : ''});
                    changeQuery()
                }}
            />

            <ToggleControl
                label={__("Fade", "user-grid")}
                className="dowp-toggle-control-field"
                checked={fade}
                onChange={(fade) => {
                    setAttributes({fade: fade ? 'show' : ''});
                    changeQuery()
                }}
            />

            <ToggleControl
                label={__("Autoplay", "user-grid")}
                className="dowp-toggle-control-field"
                checked={autoplay}
                onChange={(autoplay) => {
                    setAttributes({autoplay: autoplay ? 'show' : ''});
                    changeQuery()
                }}
            />

            <ToggleControl
                label={__("Adaptive Height", "user-grid")}
                className="dowp-toggle-control-field"
                checked={adaptiveHeight}
                onChange={(adaptiveHeight) => {
                    setAttributes({adaptiveHeight: adaptiveHeight ? 'show' : ''});
                    changeQuery()
                }}
            />

            <ToggleControl
                label={__("Infinite", "user-grid")}
                className="dowp-toggle-control-field"
                checked={infinite}
                onChange={(infinite) => {
                    setAttributes({infinite: infinite ? 'show' : ''});
                    changeQuery()
                }}
            />

            <NumberControl
                isShiftStepEnabled
                label={__("Speed", "user-grid")}
                max={5000}
                min={100}
                value={speed}
                onChange={(speed) => {
                    setAttributes({speed})
                    changeQuery()
                }}
                placeholder={__("Eg. 700", "user-grid")}
                shiftStep={400}
                step="100"
                className="dowp-control-field label-inline"
            />

            <NumberControl
                isShiftStepEnabled
                label={__("Autoplay Speed", "user-grid")}
                max={20000}
                min={100}
                value={autoplaySpeed}
                onChange={(autoplaySpeed) => {
                    setAttributes({autoplaySpeed})
                    changeQuery()
                }}
                placeholder={__("Eg. 30000", "user-grid")}
                shiftStep={500}
                step="100"
                className="dowp-control-field label-inline"
            />

        </PanelBody>

    );
}