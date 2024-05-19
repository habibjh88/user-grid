/* global wp */
import {useCallback, useEffect, useRef, useState} from "react";

const {__} = wp.i18n
import './scss/devices.scss'
import useClickOutside from "../helpers/useClickOutside";

const Devices = (props) => {
    const [switcherIsOpen, setSwitcherIsOpen] = useState(false);
    const [device, setDevice] = useState(() => props.device || 'lg');
    const devicesRef = useRef();
    const closeDevices = useCallback(() => setSwitcherIsOpen(false), []);
    useEffect(() => {
        if (device) {
            window.dowpDevice = device
        }
    }, [])
    const onClickHandler = (_device) => {
        window.dowpDevice = _device;
        setDevice(_device);
        props.onChange(_device);
        setSwitcherIsOpen(() => !switcherIsOpen)
    }
    useClickOutside(devicesRef, closeDevices);

    return <div ref={devicesRef}
                className={`dowp-device-switchers active-${device}${switcherIsOpen ? ' dowp-device-switchers-open' : ''} `}
                onClick={() => setSwitcherIsOpen(() => !switcherIsOpen)}>
        <div className="dowp-device-switchers-wrap">
            <a className={`dowp-device-switcher dowp-device-switcher-desktop${device === 'lg' ? ' active' : ''}`}
               onClick={() => onClickHandler('lg')} data-tooltip={__('Desktop')}>
                <i className="dashicons dashicons-desktop"></i>
            </a>
            <a className={`dowp-device-switcher dowp-device-switcher-laptop${device === 'md' ? ' active' : ''}`}
               onClick={() => onClickHandler('md')} data-tooltip={__('Tablet')}>
                <i className="dashicons dashicons-tablet"></i>
            </a>
            <a className={`dowp-device-switcher dowp-device-switcher-tablet${device === 'sm' ? ' active' : ''}`}
               onClick={() => onClickHandler('sm')} data-tooltip={__('Mobile')}>
                <i className="dashicons dashicons-smartphone"></i>
            </a>
            {/* <a className={`dowp-device-switcher dowp-device-switcher-smartphone${device === 'xs' ? ' active' : ''}`}
			 onClick={() => onClickHandler('xs')} data-tooltip={__('Phone')}>
			 <i className="dashicons dashicons-smartphone" />
			 </a> */}
        </div>
    </div>
}

export default Devices;