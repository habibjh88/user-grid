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
        <div className="usgr-control-field usgr-cf-background-wrap">

            <div className='usgr-cf-body'>
                <div className="usgr-cf-body-btn-wrap">

                    {label && (
                        <div className="usgr-cf-head">
                            <span className="usgr-label">{label}</span>
                        </div>
                    )}

                    <ButtonGroup className="usgr-btn-group">
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
                                            <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.3266 0.178943C10.7084 0.243977 9.96474 0.655477 9.05299 1.43694C7.40349 2.85076 5.45772 5.2919 4.20456 7.0483C3.28953 6.90559 2.32512 7.29692 1.7541 8.01069C0.706002 9.32085 1.58341 10.49 0.594782 11.5325C0.422628 11.714 0.484042 12.0122 0.714203 12.1107C2.33159 12.8032 4.39909 12.3716 5.36897 11.3489C5.96171 10.7239 6.28422 9.80124 6.12221 8.93263C7.85552 7.60265 10.2503 5.55249 11.6065 3.8516C12.3574 2.90973 12.7385 2.15208 12.7715 1.53536C12.816 0.704516 12.1712 0.0901686 11.3266 0.178943ZM4.84701 10.8538C4.19087 11.5457 2.73918 11.9486 1.44742 11.6041C2.1697 10.452 1.54883 9.41893 2.31584 8.46015C2.94522 7.67341 4.21108 7.45315 4.94668 8.18877C5.8061 9.04829 5.40578 10.2646 4.84701 10.8538ZM4.92063 7.2846C5.09698 7.04079 5.37355 6.66435 5.71893 6.21367L6.89924 7.39407C6.4646 7.75152 6.10158 8.03817 5.86624 8.22124C5.65421 7.84046 5.32607 7.49924 4.92063 7.2846ZM12.0532 1.49689C11.9724 3.00774 8.60382 5.9577 7.45385 6.9313L6.16408 5.64141C7.11028 4.44336 9.88726 1.05372 11.4019 0.894439C11.806 0.851874 12.074 1.10686 12.0532 1.49689Z" fill="black"/>
                                            </svg>
                                        </span>
                                        :
                                        <span className="gradient-btn">
                                           <svg width="17" height="11" viewBox="0 0 17 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.3566 0.0400391H1.89146C1.36234 0.0400391 0.361328 0.276486 0.361328 1.17137V9.31692C0.361328 9.70813 0.681125 10.4482 1.89146 10.4482H15.3566C15.8857 10.4482 16.8867 10.2118 16.8867 9.31692V1.17137C16.8867 0.780153 16.5669 0.0400391 15.3566 0.0400391ZM4.03364 0.49257H4.64569V9.99571H4.03364V0.49257ZM3.42159 9.99571H2.80953V0.49257H3.42159V9.99571ZM5.25774 0.49257H6.17582V9.99571H5.25774V0.49257ZM6.78787 0.49257H7.70595V9.99571H6.78787V0.49257ZM8.318 0.49257H9.5421V9.99571H8.318V0.49257ZM10.1542 0.49257H11.3783V9.99571H10.1542V0.49257ZM0.97338 9.31692V1.17137C0.97338 0.901884 1.11017 0.739878 1.27941 0.641905V9.84977C1 9.67374 0.974604 9.39249 0.97338 9.31692ZM1.89146 0.49257H2.19748V9.99571H1.89146V0.49257ZM16.2747 9.31692C16.2747 9.95476 15.5102 9.99435 15.3554 9.99571H11.9903V0.49257H15.3566C16.2205 0.49257 16.2728 1.05891 16.2747 1.17137V9.31692Z" fill="black"/>
                                            </svg>
                                        </span>
                                    }

                                </Button>
                            </Tooltip>

                        ))}
                    </ButtonGroup>

                </div>

                <div className="usgr-cf-body-content-wrap">
                    {value['type'] === "classic" && (
                        <BGImage
                            image={props?.image}
                            value={value['classic']}
                            onChange={val => setSettings(val, 'classic')}
                        />
                    )}

                    {value['type'] === "gradient" && (
                       <div className={`usgr-gradient-color-wrap`}>
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