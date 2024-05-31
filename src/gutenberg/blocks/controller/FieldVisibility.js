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
        job_role_visibility,
        bio_visibility,
        social_visibility,
        hr_1,
        hr_2
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
                label={__("Horizontal Line - 1", "user-grid")}
                className="dowp-toggle-control-field"
                checked={hr_1}
                onChange={(hr_1) => {
                    setAttributes({hr_1: hr_1 ? 'show' : ''});
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
                label={__("Job Role", "user-grid")}
                className="dowp-toggle-control-field"
                checked={job_role_visibility}
                onChange={(job_role_visibility) => {
                    setAttributes({job_role_visibility: job_role_visibility ? 'show' : ''});
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
                label={__("Horizontal Line - 2", "user-grid")}
                className="dowp-toggle-control-field"
                checked={hr_2}
                onChange={(hr_2) => {
                    setAttributes({hr_2: hr_2 ? 'show' : ''});
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