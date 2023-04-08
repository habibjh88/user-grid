const {__} = wp.i18n
import PropTypes from "prop-types";

function ImageAvater({imageUrl, onDeleteImage, onEditImage = null}) {

    return (
        <div className="gtusers-image-avatar" style={{backgroundImage: `url(${imageUrl})`}}>
            <button className="open-image-button" onClick={onEditImage}></button>

            <div className={`gtusers-media-actions`}>
                {/*<button className="button gtusers-btn-edit" onClick={ onEditImage }>*/}
                {/*    <span aria-label={ __( 'Edit' ) } className="dashicons dashicons-edit-large"/>*/}
                {/*</button>*/}

                <button className="button gtusers-btn-delete" onClick={() => onDeleteImage()}>
                    <span aria-label={__('Close')} className="dashicons dashicons-trash"/>
                </button>
            </div>

        </div>
    )

}

ImageAvater.propTypes = {
    imageUrl: PropTypes.string.isRequired,
    onDeleteImage: PropTypes.func.isRequired
};

export default ImageAvater;
