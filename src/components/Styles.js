const {__} = wp.i18n;
import './scss/styles.scss'
import cogoToast from "cogo-toast";

function Styles(props) {

    const {label, value, options, columns = 3, onChange} = props

    return (
        <div className="gtusers-control-field gtusers-cf-styles-wrap">

            {label && (
                <div className="gtusers-cf-head">
                    <span className="gtusers-label">{label}</span>
                </div>
            )}
            <div className={`gtusers-style-list gtusers-style-columns-${columns}`}>
                {options.map((data, index) => (
                    <div
                        role="button"
                        tabindex={index} aria-label={data.label ? data.label : ''}
                        onClick={() => {
                            (! gtusersParams.hasPro && data.isPro) ?
                                cogoToast.warn('Please install "The Post Grid Pro" for this layout!',{ position: 'top-right' })
                                :
                            onChange(data.value)
                        }}
                        className={`${value == data.value ? 'gtusers-active' : ''} ${(! gtusersParams.hasPro && data.isPro) ? 'is-pro' : ''}`}
                    >
                        {data.icon && <span className="gtusers-layout gtusers-style-icon">{data.icon}</span>}
                        {data.label && <span className="gtusers-label">{data.label}</span>}
                        {(! gtusersParams.hasPro && data.isPro) && <span className={`pro-lable`}>{__('Pro','gutenberg-users')}</span>}
                    </div>
                ))}

            </div>
        </div>
    )

}




export default Styles