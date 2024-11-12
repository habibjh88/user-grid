import {__} from "@wordpress/i18n";
import {__experimentalNumberControl as NumberControl, Button, PanelBody, SelectControl} from '@wordpress/components';
import {Dimension, Color } from "../../components/Components";
import {ALIGNMENT, NORMAL_HOVER } from "../../components/Constants";
import {useState} from "@wordpress/element";

export default function SliderStyle(props) {
    const {attributes, setAttributes} = props.data;
    const [styleTab1, setStyleTab1] = useState('normal');
    const [styleTab2, setStyleTab2] = useState('normal');
    //All attribute
    const {
        slider_gap,
        arrow_width,
        arrow_radius,
        arrow_color,
        arrow_bg,
        arrow_color_hover,
        arrow_bg_hover,
        dots_padding,
        dots_color,
        dots_active_color,
        dots_color_hover,
        dots_alignment,
        dots_position,
        dot_width,
        dot_height,
        dot_radius,
    } = attributes;

    return (
        <PanelBody title={__('Slider', 'user-grid')} initialOpen={false}>

            <NumberControl
                isShiftStepEnabled
                label={__("Slider Gap", "user-grid")}
                max={100}
                min={0}
                value={slider_gap}
                onChange={(slider_gap) => {
                    setAttributes({slider_gap})
                }}
                placeholder={__("Eg. 15", "user-grid")}
                shiftStep={5}
                step="1"
                className="usgr-control-field label-inline"
            />

            <h3 className={`usgr-controll-heading`}>{__("Arrow Style", "user-grid")}</h3>

            <NumberControl
                isShiftStepEnabled
                label={__("Arrow Width", "user-grid")}
                max={100}
                min={10}
                value={arrow_width}
                onChange={(arrow_width) => {
                    setAttributes({arrow_width})
                }}
                placeholder={__("Eg. 10", "user-grid")}
                shiftStep={5}
                step="1"
                className="usgr-control-field label-inline"
            />
            <NumberControl
                isShiftStepEnabled
                label={__("Arrow Radius", "user-grid")}
                max={150}
                min={0}
                value={arrow_radius}
                onChange={(arrow_radius) => {
                    setAttributes({arrow_radius})
                }}
                placeholder={__("Eg. 10", "user-grid")}
                shiftStep={5}
                step="1"
                className="usgr-control-field label-inline"
            />

            <div className="usgr-btn-hover-group">
                {NORMAL_HOVER.map((item, key) => (
                    <Button
                        key={key}
                        isPrimary={styleTab1 === item.value}
                        isSecondary={styleTab1 !== item.value}
                        onClick={() => setStyleTab1(item.value)}
                    >
                        {item.label}
                    </Button>
                ))}
            </div>

            {'normal' === styleTab1 &&
                <>
                    <Color
                        label={__('Arrow Color', 'user-grid')}
                        color={arrow_color}
                        onChange={(arrow_color) => setAttributes({arrow_color})}
                    />
                    <Color
                        label={__('Arrow Background', 'user-grid')}
                        color={arrow_bg}
                        onChange={(arrow_bg) => setAttributes({arrow_bg})}
                    />
                </>
            }

            {'hover' === styleTab1 &&
                <>
                    <Color
                        label={__('Arrow Color - Hover', 'user-grid')}
                        color={arrow_color_hover}
                        onChange={(arrow_color_hover) => setAttributes({arrow_color_hover})}
                    />
                    <Color
                        label={__('Arrow Background - Hover', 'user-grid')}
                        color={arrow_bg_hover}
                        onChange={(arrow_bg_hover) => setAttributes({arrow_bg_hover})}
                    />
                </>
            }


            <h3 className={`usgr-controll-heading`}>{__("Dot Style", "user-grid")}</h3>


            <SelectControl
                label={__("Dots Alignment", "user-grid")}
                className="usgr-control-field label-inline usgr-expand"
                value={dots_alignment}
                options={ALIGNMENT}
                onChange={(dots_alignment) => {
                    setAttributes({dots_alignment})
                }}
            />

            <SelectControl
                label={__("Dots Positioin", "user-grid")}
                className="usgr-control-field label-inline usgr-expand"
                value={dots_position}
                options={[
                    {value: '-1', label: __('Top', 'user-grid')},
                    {value: '10', label: __('Bottom', 'user-grid')},
                ]}
                onChange={(dots_position) => {
                    setAttributes({dots_position})
                }}
            />

            <NumberControl
                isShiftStepEnabled
                label={__("Dot Width", "user-grid")}
                max={50}
                min={2}
                value={dot_width}
                onChange={(dot_width) => {
                    setAttributes({dot_width})
                }}
                placeholder={__("Eg. 10", "user-grid")}
                shiftStep={5}
                step="1"
                className="usgr-control-field label-inline"
            />
            <NumberControl
                isShiftStepEnabled
                label={__("Dot Height", "user-grid")}
                max={50}
                min={2}
                value={dot_height}
                onChange={(dot_height) => {
                    setAttributes({dot_height})
                }}
                placeholder={__("Eg. 10", "user-grid")}
                shiftStep={5}
                step="1"
                className="usgr-control-field label-inline"
            />
            <NumberControl
                isShiftStepEnabled
                label={__("Dot Radius", "user-grid")}
                max={100}
                min={0}
                value={dot_radius}
                onChange={(dot_radius) => {
                    setAttributes({dot_radius})
                }}
                placeholder={__("Eg. 10", "user-grid")}
                shiftStep={5}
                step="1"
                className="usgr-control-field label-inline"
            />

            <Dimension
                label={__("Dots Spacing", "user-grid")}
                type="margin" responsive
                value={dots_padding}
                onChange={(value) => {
                    setAttributes({dots_padding: value})
                }}
            />

            <div className="usgr-btn-hover-group">
                {NORMAL_HOVER.map((item, key) => (
                    <Button
                        key={key}
                        isPrimary={styleTab2 === item.value}
                        isSecondary={styleTab2 !== item.value}
                        onClick={() => setStyleTab2(item.value)}
                    >
                        {item.label}
                    </Button>
                ))}
            </div>

            {'normal' === styleTab2 &&
                <>
                    <Color
                        label={__('Dots Color', 'user-grid')}
                        color={dots_color}
                        onChange={(dots_color) => setAttributes({dots_color})}
                    />
                    <Color
                        label={__('Dots Active Color', 'user-grid')}
                        color={dots_active_color}
                        onChange={(dots_active_color) => setAttributes({dots_active_color})}
                    />

                </>
            }

            {'hover' === styleTab2 &&
                <>
                    <Color
                        label={__('Dots Color - Hover', 'user-grid')}
                        color={dots_color_hover}
                        onChange={(dots_color_hover) => setAttributes({dots_color_hover})}
                    />
                </>
            }
        </PanelBody>
    );
}

