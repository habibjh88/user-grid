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
            window.usgrDevice = device
        }
    }, [])
    const onClickHandler = (_device) => {
        window.usgrDevice = _device;
        setDevice(_device);
        props.onChange(_device);
        setSwitcherIsOpen(() => !switcherIsOpen)
    }
    useClickOutside(devicesRef, closeDevices);

    return <div ref={devicesRef}
                className={`usgr-device-switchers active-${device}${switcherIsOpen ? ' usgr-device-switchers-open' : ''} `}
                onClick={() => setSwitcherIsOpen(() => !switcherIsOpen)}>
        <div className="usgr-device-switchers-wrap">
            <a className={`usgr-device-switcher usgr-device-switcher-desktop${device === 'lg' ? ' active' : ''}`}
               onClick={() => onClickHandler('lg')} data-tooltip={__('Desktop')}>
                <svg width="17" height="12" viewBox="0 0 17 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1.34922 0.779785C1.1283 0.779785 0.949219 0.958871 0.949219 1.17978V8.98086C0.949219 9.20177 1.1283 9.38086 1.34922 9.38086H7.18359V11.092H6.51797C6.32467 11.092 6.16797 11.2487 6.16797 11.442C6.16797 11.6353 6.32467 11.792 6.51797 11.792H11.3805C11.5738 11.792 11.7305 11.6353 11.7305 11.442C11.7305 11.2487 11.5738 11.092 11.3805 11.092H10.7156V9.38086H16.5492C16.7701 9.38086 16.9492 9.20177 16.9492 8.98086V1.17979C16.9492 0.958871 16.7701 0.779785 16.5492 0.779785H1.34922ZM1.64922 1.47979V8.68086H16.2492V1.47979H1.64922ZM10.0156 9.38086H7.88359V11.092H10.0156V9.38086Z" fill="black"/>
                </svg>
            </a>
            <a className={`usgr-device-switcher usgr-device-switcher-laptop${device === 'md' ? ' active' : ''}`}
               onClick={() => onClickHandler('md')} data-tooltip={__('Tablet')}>
                <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.24609 12.7317H8.00586V12.0317H4.24609V12.7317Z" fill="black"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.408203 0.813769C0.408203 0.42717 0.721604 0.11377 1.1082 0.11377H11.1418C11.5284 0.11377 11.8418 0.42717 11.8418 0.813769V14.3781C11.8418 14.7647 11.5284 15.0781 11.1418 15.0781H1.1082C0.721604 15.0781 0.408203 14.7647 0.408203 14.3781V0.813769ZM1.1082 0.813769L11.1418 0.81377V14.3781H1.1082L1.1082 0.813769Z" fill="black"/>
                </svg>
            </a>
            <a className={`usgr-device-switcher usgr-device-switcher-tablet${device === 'sm' ? ' active' : ''}`}
               onClick={() => onClickHandler('sm')} data-tooltip={__('Mobile')}>
                <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.99219 12.0513C2.99219 11.9132 3.10412 11.8013 3.24219 11.8013H4.87109C5.00916 11.8013 5.12109 11.9132 5.12109 12.0513C5.12109 12.1893 5.00916 12.3013 4.87109 12.3013H3.24219C3.10412 12.3013 2.99219 12.1893 2.99219 12.0513Z" fill="black"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1.55469 0.946289C1.0024 0.946289 0.554688 1.394 0.554688 1.94629V12.0781C0.554688 12.6304 1.0024 13.0781 1.55469 13.0781H6.55859C7.11088 13.0781 7.55859 12.6304 7.55859 12.0781V1.94629C7.55859 1.394 7.11088 0.946289 6.55859 0.946289H1.55469ZM2.78136 1.44629H1.55469C1.27855 1.44629 1.05469 1.67015 1.05469 1.94629V12.0781C1.05469 12.3543 1.27855 12.5781 1.55469 12.5781H6.55859C6.83474 12.5781 7.05859 12.3543 7.05859 12.0781V1.94629C7.05859 1.67015 6.83474 1.44629 6.55859 1.44629H5.33114C5.31064 1.64798 5.1403 1.80537 4.9332 1.80537H3.1793C2.9722 1.80537 2.80186 1.64798 2.78136 1.44629Z" fill="black"/>
                </svg>
            </a>
            {/* <a className={`usgr-device-switcher usgr-device-switcher-smartphone${device === 'xs' ? ' active' : ''}`}
			 onClick={() => onClickHandler('xs')} data-tooltip={__('Phone')}>
			 <i className="dashicons dashicons-smartphone" />
			 </a> */}
        </div>
    </div>
}

export default Devices;