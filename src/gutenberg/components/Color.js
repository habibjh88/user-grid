import ResetButton from "./ResetButton";

const {__} = wp.i18n;
const {useState, useEffect} = wp.element;
const {Dropdown, Tooltip, ColorPicker, Button} = wp.components;

import './scss/color.scss'

function Color({label, color, onChange}) {

    const [bgColor, setBgColor] = useState(color);
    useEffect(() => {
        setBgColor(color);
    }, [color]);

    const onChangeComplete = ({rgb, hex}) => {
        let color = rgb ? `rgba(${rgb.r},${rgb.g},${rgb.b},${rgb.a})` : hex;
        onChange(color);
    };

    return (
        <div className="dowp-control-field components-base-control dowp-cf-color-wrap">

            {label && (
                <span className="dowp-label">{label}</span>
            )}

            <div className="dowp-color">
                <Dropdown
                    contentClassName="dowp-components-popover dowp-cp-color-content"
                    renderToggle={({isOpen, onToggle}) => (
                        <Tooltip text={color || "default"}>
                            <div className="dowp-color-ball">
                                <div
                                    style={{
                                        height: 25,
                                        width: 25,
                                        borderRadius: "50%",
                                        boxShadow: "inset 0 0 0 1px rgba(0,0,0,.1)",
                                        backgroundColor: bgColor,
                                    }}
                                    aria-expanded={isOpen}
                                    onClick={onToggle}
                                    aria-label={color || "default"}
                                ></div>
                            </div>
                        </Tooltip>
                    )}
                    renderContent={() => (
                        <ColorPicker
                            color={color}
                            onChangeComplete={(color) => onChangeComplete(color)}
                        />
                    )}
                />
                {bgColor && (
                    <ResetButton onChange={() => onChange(undefined)}/>
                )}
            </div>

        </div>
    );
};

export default Color;
