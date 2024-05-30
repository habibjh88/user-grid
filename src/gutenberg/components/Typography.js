const {__} = wp.i18n;
const {useState, useEffect} = wp.element;
const {Dropdown, Button, SelectControl} = wp.components;

import RangeDevice from "./RangeDevice";
import {FONT_WEIGHTS, TEXT_DECORATION, TEXT_TRANSFORM} from "./Constants";
import "./scss/typography.scss";

function Typography(props) {

    const {label, value: data, onChange} = props;
    const setSettings = (val, type) => {
        const newData = JSON.parse(JSON.stringify(data));
        newData[type] = val;
        onChange(newData);
    };

    return (
        <div className="dowp-control-field components-base-control dowp-cf-typography-wrap">

            {label && (
                <span className="dowp-label">{label}</span>
            )}

            <div className="dowp-typography">
                <Dropdown
                    className="dowp-typography-dropdown-icon"
                    contentClassName="dowp-components-popover dowp-cp-typography-content"
                    position="bottom right"
                    renderToggle={({isOpen, onToggle}) => (
                        <Button
                            isSmall
                            onClick={onToggle}
                            aria-expanded={isOpen}
                        >
                            <svg width="10" height="11" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.55838 9.01655H6.63607C6.77898 9.01655 6.91604 9.07332 7.01709 9.17437C7.11814 9.27542 7.17491 9.41248 7.17491 9.55539C7.17491 9.6983 7.11814 9.83536 7.01709 9.93641C6.91604 10.0375 6.77898 10.0942 6.63607 10.0942H3.40299C3.26008 10.0942 3.12303 10.0375 3.02197 9.93641C2.92092 9.83536 2.86415 9.6983 2.86415 9.55539C2.86415 9.41248 2.92092 9.27542 3.02197 9.17437C3.12303 9.07332 3.26008 9.01655 3.40299 9.01655H4.48069V1.47271H1.24761V2.5504C1.24761 2.69331 1.19084 2.83037 1.08979 2.93142C0.988735 3.03248 0.851678 3.08925 0.708767 3.08925C0.565857 3.08925 0.428799 3.03248 0.327746 2.93142C0.226693 2.83037 0.169922 2.69331 0.169922 2.5504V0.933865C0.169922 0.790954 0.226693 0.653897 0.327746 0.552844C0.428799 0.451791 0.565857 0.39502 0.708767 0.39502H9.3303C9.47321 0.39502 9.61026 0.451791 9.71132 0.552844C9.81237 0.653897 9.86914 0.790954 9.86914 0.933865V2.5504C9.86914 2.69331 9.81237 2.83037 9.71132 2.93142C9.61026 3.03248 9.47321 3.08925 9.3303 3.08925C9.18738 3.08925 9.05033 3.03248 8.94927 2.93142C8.84822 2.83037 8.79145 2.69331 8.79145 2.5504V1.47271H5.55838V9.01655Z" fill="black"/>
                            </svg>
                        </Button>
                    )}

                    renderContent={() => (

                        <div className="dowp-typography-content">
                            <RangeDevice
                                label={__('Font Size')}
                                responsive={true}
                                value={data['size']}
                                units={['px', 'em', '%']}
                                min={1}
                                max={data["size"]["unit"] === "em" ? 10 : 200}
                                step={data["size"]["unit"] === "em" ? 0.1 : 1}
                                onChange={(val) => setSettings(val, 'size')}
                            />

                            <SelectControl
                                label={__("Font Weight")}
                                value={data["weight"]}
                                options={FONT_WEIGHTS}
                                onChange={(val) =>
                                    setSettings(val, 'weight')
                                }
                            />
                            <SelectControl
                                label={__("Text Transform")}
                                value={data["transform"]}
                                options={TEXT_TRANSFORM}
                                onChange={(val) =>
                                    setSettings(val, 'transform')
                                }
                            />
                            <SelectControl
                                label={__("Text Decoration")}
                                value={data["decoration"]}
                                options={TEXT_DECORATION}
                                onChange={(val) =>
                                    setSettings(val, 'decoration')
                                }
                            />
                            <RangeDevice
                                label={__('Letter Spacing')}
                                responsive={true}
                                value={data['spacing']}
                                units={['px', 'em']}
                                min={-5}
                                max={data["spacing"]["unit"] === "em" ? 10 : 100}
                                step={data["spacing"]["unit"] === "em" ? 0.1 : 1}
                                onChange={(val) => setSettings(val, 'spacing')}
                            />
                            <RangeDevice
                                label={__('Line Height')}
                                responsive={true}
                                value={data['height']}
                                units={['px', 'em']}
                                min={1}
                                max={data["height"]["unit"] === "em" ? 10 : 100}
                                step={data["height"]["unit"] === "em" ? 0.1 : 1}
                                onChange={(val) => setSettings(val, 'height')}
                            />

                        </div>
                    )}


                />

            </div>
        </div>
    );
};

export default Typography;
