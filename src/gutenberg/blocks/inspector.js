import SliderStyle from "./controller/SliderStyle";

const {InspectorControls} = wp.blockEditor;
import {TabPanel} from "@wordpress/components";
import TabTitle from "../components/TabTitle";
import {
    ContentQuery,
    ContentSlider,
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
    Pagination,
    RecentPost
} from "./controller/Controllers";

function Inspector(props) {
    const {attributes, changeQuery, userData} = props;

    //All attribute
    const {
        hasPro,
        layout_style,
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
        pagination_visibility,
        post_visibility
    } = attributes;

    return (
        <InspectorControls key="controls">
            <div className="usgr-panel-control-wrapper">
                <TabPanel className="usgr-tab-panel" activeClass="active-tab" tabs={[
                    {
                        name: "content",
                        title: <TabTitle title={`Content`} icon={`dashicons-edit`}/>,
                        className: "usgr-tab-btn content",
                    },
                    {
                        name: "styles",
                        title: <TabTitle title={`Settings / Styles`} icon={`dashicons-admin-generic`}/>,
                        className: "usgr-tab-btn settings",
                    }
                ]}
                >
                    {(tab) => (
                        <div className="usgr-tab-content">

                            {/* Content Tab*/}
                            {tab.name === "content" && (
                                <>
                                    <ContentLayout data={props}/>
                                    <ContentQuery data={props}/>
                                    {layout_style === 'slider' && <ContentSlider data={props}/>}
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
                                    {layout_style === 'slider' && <SliderStyle data={props}/>}
                                    {pagination_visibility && <Pagination data={props}/>}
                                    {(hr_1_visibility || hr_2_visibility) && <HrSetting data={props}/>}
                                    {post_visibility && <RecentPost data={props}/>}
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