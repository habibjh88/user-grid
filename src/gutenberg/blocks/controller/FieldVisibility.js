import {__} from "@wordpress/i18n";
import {ToggleControl} from '@wordpress/components';
import {PanelBody} from "@wordpress/components";

function FieldVisibility(props) {
    const {attributes, setAttributes, changeQuery} = props.data;

    //All attribute
    const {
        avatar_visibility,
        name_visibility,
        email_visibility,
        phone_visibility,
        designation_visibility,
        short_desc_visibility,
        bio_visibility,
        social_visibility,
        button_visibility
    } = attributes;

    return (
        <PanelBody title={__('Field Visibility', 'user-grid')} initialOpen={true}>

            <ToggleControl
                label={__("Image", "user-grid")}
                className="dowp-toggle-control-field"
                checked={avatar_visibility}
                onChange={(avatar_visibility) => {
                    setAttributes({avatar_visibility: avatar_visibility ? 'show' : ''});
                    changeQuery()
                }}
            />

            <ToggleControl
                label={__("Name", "user-grid")}
                className="dowp-toggle-control-field"
                checked={name_visibility}
                onChange={(name_visibility) => {
                    setAttributes({name_visibility: name_visibility ? 'show' : ''});
                    changeQuery();
                }}
            />

            <ToggleControl
                label={__("Designation", "user-grid")}
                className="dowp-toggle-control-field"
                checked={designation_visibility}
                onChange={(designation_visibility) => {
                    setAttributes({designation_visibility: designation_visibility ? 'show' : ''});
                    changeQuery();
                }}
            />

            <ToggleControl
                label={__("Short Description", "user-grid")}
                className="dowp-toggle-control-field"
                checked={short_desc_visibility}
                onChange={(short_desc_visibility) => {
                    setAttributes({short_desc_visibility: short_desc_visibility ? 'show' : ''});
                    changeQuery();
                }}
            />


            <ToggleControl
                label={__("Email", "user-grid")}
                className="dowp-toggle-control-field"
                checked={email_visibility}
                onChange={(email_visibility) => {
                    setAttributes({email_visibility: email_visibility ? 'show' : ''});
                    changeQuery();
                }}
            />

            <ToggleControl
                label={__("Phone", "user-grid")}
                className="dowp-toggle-control-field"
                checked={phone_visibility}
                onChange={(phone_visibility) => {
                    setAttributes({phone_visibility: phone_visibility ? 'show' : ''});
                    changeQuery();
                }}
            />


            <ToggleControl
                label={__("Biography", "user-grid")}
                className="dowp-toggle-control-field"
                checked={bio_visibility}
                onChange={(bio_visibility) => {
                    setAttributes({bio_visibility: bio_visibility ? 'show' : ''});
                    changeQuery();
                }}
            />

            <ToggleControl
                label={__("Social Icon", "user-grid")}
                className="dowp-toggle-control-field"
                checked={social_visibility}
                onChange={(social_visibility) => {
                    setAttributes({social_visibility: social_visibility ? 'show' : ''});
                    changeQuery();
                }}
            />


            <ToggleControl
                label={__("Read Articles Button", "user-grid")}
                className="dowp-toggle-control-field"
                checked={button_visibility}
                onChange={(button_visibility) => {
                    setAttributes({button_visibility: button_visibility ? 'show' : ''});
                    changeQuery();
                }}
            />


        </PanelBody>
    );
}

export default FieldVisibility;