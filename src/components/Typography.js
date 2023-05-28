const {__} = wp.i18n;
const {useState, useEffect} = wp.element;
const {Dropdown, Button, SelectControl} = wp.components;

import RangeDevice from "./RangeDevice";
import {FONT_WEIGHTS, TEXT_TRANSFORM} from "./Constants";
import "./scss/typography.scss";

function Typography(props) {

    const {label, value: data, onChange} = props;
    const setSettings = (val, type) => {
        const newData = JSON.parse(JSON.stringify(data));
        newData[type] = val;
        onChange(newData);
    };

    let iconSVG = <svg width="15" height="12" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.714111 0H9.13693V1.43879H9.13709V2.54784H7.45852V1.67857H5.7499L5.7499 10.0714H7.42846V11.75H2.39275V10.0714H4.07133L4.07133 1.67857H2.39275V2.54784H0.714186L0.714186 1.67857H0.714111V0Z" fill="#565D66"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.1427 4.19641H7.42847V5.87498H7.42847L7.42847 6.74427H9.10704V5.87498H9.94633L9.94633 10.0714H9.10704V11.75H12.5241V10.0714H11.6249V5.87498H12.4642V6.74427H14.1427V6.74422V5.63517V5.62201H14.1427V4.19641Z" fill="#565D66"/>
    </svg>


    return (
        <div className="gtusers-control-field components-base-control gtusers-cf-typography-wrap">

            {label && (
                <span className="gtusers-label">{label}</span>
            )}

            <div className="gtusers-typography">
                <Dropdown
                    className="gtusers-typography-dropdown-icon"
                    contentClassName="gtusers-components-popover gtusers-cp-typography-content"
                    position="bottom right"
                    renderToggle={({isOpen, onToggle}) => (
                        <Button
                            isSmall
                            onClick={onToggle}
                            aria-expanded={isOpen}
                            icon={iconSVG}
                        ></Button>
                    )}

                    renderContent={() => (

                        <div className="gtusers-typography-content">
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
