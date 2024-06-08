const {InspectorControls} = wp.blockEditor;
import {TabPanel} from "@wordpress/components";
import TabTitle from "../components/TabTitle";
import {
    ContentQuery,
    ContentLayout,
    ContentSort,
    ContentGlobal,
    FieldVisibility,
    AvatarSettings,
    NameSettings,
    JobRole,
    BioSettings,
    DesignationSettings,
    SocialShareSettings,
    ReadArticleBtn,
    CardSettings,
    EmailSettings,
    PhoneSettings,
    HrSetting,
    Pagination
} from "./controller/Controllers";

function Inspector(props) {
    const {attributes, changeQuery, userData} = props;

    //All attribute
    const {
        hasPro,
        avatar_visibility,
        name_visibility,
        designation_visibility,
        bio_visibility,
        social_visibility,
        job_role_visibility,
        button_visibility,
        email_visibility,
        phone_visibility,
        hr_1_visibility,
        hr_2_visibility,
        pagination_visibility
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
                                    <ContentGlobal data={props}/>
                                </>
                            )}

                            {/* Style Tab*/}
                            {tab.name === "styles" && (
                                <>
                                    <FieldVisibility data={props}/>
                                    {avatar_visibility && <AvatarSettings data={props}/>}
                                    {name_visibility && <NameSettings data={props}/>}
                                    {job_role_visibility && <JobRole data={props}/>}
                                    {designation_visibility && <DesignationSettings data={props}/>}
                                    {email_visibility && <EmailSettings data={props}/>}
                                    {phone_visibility && <PhoneSettings data={props}/>}
                                    {bio_visibility && <BioSettings data={props}/>}
                                    {social_visibility && <SocialShareSettings data={props}/>}
                                    {button_visibility && <ReadArticleBtn data={props}/>}
                                    {pagination_visibility && <Pagination data={props}/>}
                                    {(hr_1_visibility || hr_2_visibility) && <HrSetting data={props}/>}
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