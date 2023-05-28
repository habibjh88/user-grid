const {__} = wp.i18n;
const {useState, useEffect} = wp.element;
const {GradientPicker} = wp.components;
import "./scss/gradient.scss";

function Gradient(props) {
    const {label, value, onChange} = props;

    const setSettings = (val) => {
        onChange(val)
    }

    return (

        <div className="gtusers-control-field components-base-control gtusers-cf-gradient-wrap">

            {label && (
                <div className="gtusers-cf-head">
                    <span className="gtusers-label">{label}</span>
                </div>
            )}

            <div className="gtusers-cf-body">
                <GradientPicker
                    label={'helloooooo'}
                    value={value}
                    onChange={(val) => setSettings(val)}


                    gradients={[
                        {
                            name: 'Green',
                            gradient:
                                'linear-gradient(135deg, #80F1A6 0%, #EFD000 100%)',
                            slug: 'green',
                        },
                        {
                            name: 'Blue',
                            gradient:
                                'linear-gradient(45deg, #009FFF 0%, #0A51BB 100%)',
                            slug: 'blue',
                        },
                        {
                            name: 'Dark Blue',
                            gradient:
                                'linear-gradient(50deg, #15D2E3 10%, #11D6E2 40%, #10D7E2 80%)',
                            slug: 'darkBlue',
                        },
                        {
                            name: 'Yellow',
                            gradient:
                                'linear-gradient(135deg, #FBDA61 2.88%, #F76B1C 98.13%)',
                            slug: 'yellow',
                        },
                        {
                            name: 'Merun',
                            gradient:
                                'linear-gradient(135deg, #E25544 2.88%, #620C90 98.14%)',
                            slug: 'merun',
                        },
                    ]}
                />
            </div>

        </div>
    )
}

export default Gradient;