const {__} = wp.i18n;
const {useState, useEffect} = wp.element;
const {Button, ButtonGroup, Tooltip} = wp.components;
import {BACKGROUND_TYPE} from './Constants'

import Gradient from './Gradient';
import BGImage from './BGImage';
import ResetButton from './ResetButton';

import './scss/background.scss'

function Background(props) {

    const defaultData = {
        openBGColor: 0,
        type: 'classic',
        classic: {
            'color': '',
            'img': {'imgURL': '', 'imgID': ''},
            'imgProperty': {
                'imgPosition': {'lg': ''},
                'imgAttachment': {'lg': ''},
                'imgRepeat': {'lg': ''},
                'imgSize': {'lg': ''},
            },
        },
        gradient: null,
    };

    const {label, value, onChange} = props;

    const setSettings = (val, type) => {
        onChange(Object.assign({}, defaultData, (value || {}), {openBGColor: 1}, {[type]: val}));
    }

    return (
        <div className="dowp-control-field dowp-cf-background-wrap">

            <div className='dowp-cf-body'>
                <div className="dowp-cf-body-btn-wrap">

                    {label && (
                        <div className="dowp-cf-head">
                            <span className="dowp-label">{label}</span>
                        </div>
                    )}

                    <ButtonGroup className="dowp-btn-group">
                        {BACKGROUND_TYPE.map((item) => (

                            <Tooltip text={item.label} position="top" delay={0}>
                                <Button
                                    isLarge
                                    isPrimary={value['type'] === item.value}
                                    isSecondary={value['type'] !== item.value}
                                    onClick={() => setSettings(item.value, 'type')}
                                >
                                    {item.value === 'classic' ?
                                        <span className="classic-btn">
                                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14.61 0.18153C13.8044 0.26628 12.8353 0.80253 11.6471 1.82091C9.49754 3.66334 6.96189 6.84453 5.32882 9.13341C4.13639 8.94744 2.87961 9.45741 2.13548 10.3876C0.769638 12.0949 1.91304 13.6185 0.6247 14.977C0.400357 15.2135 0.480388 15.6022 0.780325 15.7306C2.88804 16.6329 5.58233 16.0705 6.84623 14.7378C7.61867 13.9233 8.03895 12.7209 7.82783 11.589C10.0866 9.85581 13.2074 7.18412 14.9747 4.96759C15.9533 3.74019 16.45 2.75284 16.493 1.94915C16.5509 0.866436 15.7106 0.0658425 14.61 0.18153ZM6.16604 14.0926C5.31098 14.9942 3.4192 15.5193 1.73583 15.0703C2.67708 13.569 1.86798 12.2227 2.86751 10.9733C3.6877 9.94803 5.33733 9.661 6.29592 10.6196C7.41589 11.7397 6.8942 13.3248 6.16604 14.0926ZM6.26198 9.44134C6.49179 9.12362 6.8522 8.63306 7.30229 8.04575L8.84042 9.584C8.27401 10.0498 7.80095 10.4234 7.49426 10.6619C7.21795 10.1657 6.79033 9.72106 6.26198 9.44134ZM15.5568 1.89903C15.4516 3.86791 11.0618 7.71219 9.56317 8.98094L7.88239 7.3C9.11545 5.73875 12.7343 1.3215 14.7081 1.11394C15.2347 1.05847 15.584 1.39075 15.5568 1.89903Z" fill="black"/>
                                            </svg>
                                        </span>
                                        :
                                        <span className="gradient-btn">
                                            <svg width="19" height="14" viewBox="0 0 19 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.2051 0.510742H2.08008C1.48573 0.510742 0.361328 0.804648 0.361328 1.91699V12.042C0.361328 12.5283 0.720547 13.4482 2.08008 13.4482H17.2051C17.7994 13.4482 18.9238 13.1543 18.9238 12.042V1.91699C18.9238 1.43071 18.5646 0.510742 17.2051 0.510742ZM4.48633 1.07324H5.17383V12.8857H4.48633V1.07324ZM3.79883 12.8857H3.11133V1.07324H3.79883V12.8857ZM5.86133 1.07324H6.89258V12.8857H5.86133V1.07324ZM7.58008 1.07324H8.61133V12.8857H7.58008V1.07324ZM9.29883 1.07324H10.6738V12.8857H9.29883V1.07324ZM11.3613 1.07324H12.7363V12.8857H11.3613V1.07324ZM1.04883 12.042V1.91699C1.04883 1.58202 1.20248 1.38065 1.39258 1.25887V12.7043C1.07873 12.4855 1.0502 12.1359 1.04883 12.042ZM2.08008 1.07324H2.42383V12.8857H2.08008V1.07324ZM18.2363 12.042C18.2363 12.8348 17.3776 12.8841 17.2037 12.8857H13.4238V1.07324H17.2051C18.1755 1.07324 18.2343 1.77721 18.2363 1.91699V12.042Z" fill="black"/>
                                            </svg>
                                        </span>
                                    }

                                </Button>
                            </Tooltip>

                        ))}
                    </ButtonGroup>

                </div>

                <div className="dowp-cf-body-content-wrap">
                    {value['type'] === "classic" && (
                        <BGImage
                            image={props?.image}
                            value={value['classic']}
                            onChange={val => setSettings(val, 'classic')}
                        />
                    )}

                    {value['type'] === "gradient" && (
                       <div className={`dowp-gradient-color-wrap`}>
                           <Gradient
                               value={value['gradient']}
                               onChange={(val) => setSettings(val, 'gradient')}
                           />
                           <ResetButton onChange={() => onChange(defaultData)}/>
                       </div>
                    )}
                </div>
            </div>

        </div>
    )
}

export default Background;