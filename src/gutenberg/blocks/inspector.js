const {InspectorControls} = wp.blockEditor;
import {TabPanel} from "@wordpress/components";
import TabTitle from "../components/TabTitle";
import {
    ContentQuery,
    ContentLayout,
    FieldVisibility,
    AvatarSettings,
    NameSettings,
    ShortDesc,
    BioSettings,
    DesignationSettings,
    SocialShareSettings,
    ReadArticleBtn,
    CardSettings,
    ContentSort,
    EmailSettings,
    PhoneSettings
} from "./controller/Controllers";

function Inspector(props) {
    const {attributes, changeQuery, userData} = props;

    //All attribute
    const {
        avatar_visibility,
        name_visibility,
        designation_visibility,
        bio_visibility,
        social_visibility,
        job_role_visibility,
        button_visibility,
        email_visibility,
        phone_visibility
    } = attributes;

    return (
        <InspectorControls key="controls">
            <div className="dowp-panel-control-wrapper">
                <TabPanel className="dowp-tab-panel" activeClass="active-tab" tabs={[
                    {
                        name: "content",
                        title: <TabTitle title={`Content`} icon={`dashicons-edit`}/>,
                        className: "dowp-tab-btn content",
                    },
                    {
                        name: "styles",
                        title: <TabTitle title={`Settings / Styles`} icon={`dashicons-admin-generic`}/>,
                        className: "dowp-tab-btn settings",
                    }
                ]}
                >
                    {(tab) => (
                        <div className="dowp-tab-content">

                            {/* Content Tab*/}
                            {tab.name === "content" && (
                                <>
                                    <ContentLayout data={props}/>
                                    <ContentQuery data={props}/>
                                    <ContentSort data={props}/>
                                </>
                            )}

                            {/* Style Tab*/}
                            {tab.name === "styles" && (
                                <>
                                    <FieldVisibility data={props}/>
                                    {avatar_visibility && <AvatarSettings data={props}/>}
                                    {name_visibility && <NameSettings data={props}/>}
                                    {job_role_visibility && <ShortDesc data={props}/>}
                                    {designation_visibility && <DesignationSettings data={props}/>}
                                    {email_visibility && <EmailSettings data={props}/>}
                                    {phone_visibility && <PhoneSettings data={props}/>}
                                    {bio_visibility && <BioSettings data={props}/>}
                                    {social_visibility && <SocialShareSettings data={props}/>}
                                    {button_visibility && <ReadArticleBtn data={props}/>}
                                    <CardSettings data={props}/>
                                </>
                            )}
                        </div>
                    )}
                </TabPanel>
            </div>
        </InspectorControls>
    )
}

export default Inspector;